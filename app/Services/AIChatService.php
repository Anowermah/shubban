<?php

namespace App\Services;

use App\Models\AIChatSetting;
use App\Models\AIChatKnowledgeBase;
use App\Models\AIChatMessage;
use App\Models\Setting;
use App\Models\Notice;
use App\Models\Activity;
use App\Models\Book;
use App\Models\Management;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIChatService
{
    /**
     * Generate AI response for a user query.
     */
    public function generateResponse(string $userMessage, string $sessionId, ?string $userIp = null): array
    {
        $setting = AIChatSetting::getSettings();

        // 1. Check if AI Chat is enabled
        if (!$setting->is_enabled) {
            return [
                'success' => false,
                'reply' => 'বর্তমানে এআই চ্যাট সহকারী সাময়িকভাবে বন্ধ রয়েছে। অনুগ্রহ করে সরাসরি যোগাযোগ পেজ ব্যবহার করুন।',
                'provider' => 'system',
            ];
        }

        $userMessage = trim($userMessage);
        if (empty($userMessage)) {
            return [
                'success' => false,
                'reply' => 'অনুগ্রহ করে আপনার প্রশ্নটি লিখুন।',
                'provider' => 'system',
            ];
        }

        AIChatKnowledgeBase::seedDefaultsIfEmpty();

        // 2. Try Smart Knowledge Base Match First
        $matchedKb = $this->findBestKnowledgeMatch($userMessage);

        if ($matchedKb) {
            $matchedKb->increment('hit_count');

            $reply = $this->enrichAnswerWithLiveData($matchedKb->answer, $matchedKb->category, $userMessage);

            $log = AIChatMessage::create([
                'session_id' => $sessionId,
                'user_ip' => $userIp,
                'user_message' => $userMessage,
                'bot_response' => $reply,
                'provider_used' => 'internal',
                'matched_knowledge_id' => $matchedKb->id,
                'is_resolved' => true,
            ]);

            return [
                'success' => true,
                'reply' => $reply,
                'provider' => 'internal',
                'message_id' => $log->id,
                'category' => $matchedKb->category,
            ];
        }

        // 3. Try External LLM (Gemini Free API, Groq Free API, or OpenAI) if selected & key available
        $hasKey = !empty($setting->api_key) || !empty(env('GEMINI_API_KEY')) || !empty(env('GROQ_API_KEY')) || !empty(env('OPENAI_API_KEY'));

        if ($hasKey && in_array($setting->ai_provider, ['gemini', 'groq', 'openai'])) {
            $llmReply = null;

            if ($setting->ai_provider === 'gemini') {
                $llmReply = $this->callGeminiApi($userMessage, $setting);
            } elseif ($setting->ai_provider === 'groq') {
                $llmReply = $this->callGroqApi($userMessage, $setting);
            } elseif ($setting->ai_provider === 'openai') {
                $llmReply = $this->callOpenAIApi($userMessage, $setting);
            }

            if ($llmReply) {
                $log = AIChatMessage::create([
                    'session_id' => $sessionId,
                    'user_ip' => $userIp,
                    'user_message' => $userMessage,
                    'bot_response' => $llmReply,
                    'provider_used' => $setting->ai_provider,
                    'matched_knowledge_id' => null,
                    'is_resolved' => true,
                ]);

                return [
                    'success' => true,
                    'reply' => $llmReply,
                    'provider' => $setting->ai_provider,
                    'message_id' => $log->id,
                ];
            }
        }

        // 4. Smart Site Search Fallback (Searching Leadership, Books, Notices, Activities)
        $siteSearchReply = $this->searchSiteContent($userMessage);
        if ($siteSearchReply) {
            $log = AIChatMessage::create([
                'session_id' => $sessionId,
                'user_ip' => $userIp,
                'user_message' => $userMessage,
                'bot_response' => $siteSearchReply,
                'provider_used' => 'internal_search',
                'matched_knowledge_id' => null,
                'is_resolved' => true,
            ]);

            return [
                'success' => true,
                'reply' => $siteSearchReply,
                'provider' => 'internal_search',
                'message_id' => $log->id,
            ];
        }

        // 5. Friendly Fallback
        $fallbackReply = $setting->fallback_message ?: "জাযাকাল্লাহু খাইরান। আপনার প্রশ্নটির সুনির্দিষ্ট উত্তর পাওয়া যায়নি। অনুগ্রহ করে কেন্দ্রীয় কার্যালয়ে যোগাযোগ করুন।";
        
        $log = AIChatMessage::create([
            'session_id' => $sessionId,
            'user_ip' => $userIp,
            'user_message' => $userMessage,
            'bot_response' => $fallbackReply,
            'provider_used' => 'fallback',
            'matched_knowledge_id' => null,
            'is_resolved' => false,
        ]);

        return [
            'success' => true,
            'reply' => $fallbackReply,
            'provider' => 'fallback',
            'message_id' => $log->id,
        ];
    }

    /**
     * Find best matching Knowledge Base entry using Bengali tokens & similarity.
     */
    protected function findBestKnowledgeMatch(string $query): ?AIChatKnowledgeBase
    {
        $normalizedQuery = mb_strtolower($query, 'UTF-8');
        $stopWords = ['কি', 'কী', 'কিভাবে', 'কেন', 'কবে', 'কোথায়', 'কাকে', 'কার', 'হলো', 'হবে', 'করেন', 'করব', 'বলুন', 'জানান', 'চাচ্ছি', 'চাই', 'আছে', 'না', 'এবং', 'ও', 'এর', 'একটি'];
        
        // Extract query words
        $words = preg_split('/[\s,?.!;:()"\']+/u', $normalizedQuery, -1, PREG_SPLIT_NO_EMPTY);
        $searchWords = array_filter($words, function ($w) use ($stopWords) {
            return mb_strlen($w, 'UTF-8') >= 2 && !in_array($w, $stopWords);
        });

        $activeItems = AIChatKnowledgeBase::active()->get();
        if ($activeItems->isEmpty()) {
            return null;
        }

        $bestItem = null;
        $highestScore = 0;

        foreach ($activeItems as $item) {
            $score = 0;
            $normQuestion = mb_strtolower($item->question, 'UTF-8');
            $normKeywords = mb_strtolower($item->keywords ?? '', 'UTF-8');

            // Exact match
            if ($normQuestion === $normalizedQuery) {
                $score += 100;
            } elseif (str_contains($normQuestion, $normalizedQuery) || str_contains($normalizedQuery, $normQuestion)) {
                $score += 60;
            }

            // Keyword phrase match
            $keywordsList = array_map('trim', explode(',', $normKeywords));
            foreach ($keywordsList as $kw) {
                if (!empty($kw)) {
                    if ($kw === $normalizedQuery) {
                        $score += 80;
                    } elseif (str_contains($normalizedQuery, $kw)) {
                        $score += 40;
                    }
                }
            }

            // Individual word token matching
            foreach ($searchWords as $word) {
                if (str_contains($normKeywords, $word)) {
                    $score += 15;
                }
                if (str_contains($normQuestion, $word)) {
                    $score += 10;
                }
            }

            // Factor in manual priority (0 to 10)
            $score += ($item->priority * 2);

            if ($score > $highestScore) {
                $highestScore = $score;
                $bestItem = $item;
            }
        }

        // Minimum confidence threshold
        return ($highestScore >= 18) ? $bestItem : null;
    }

    /**
     * Enrich answer with actual live data from Settings, Leadership, Books, and Notices.
     */
    protected function enrichAnswerWithLiveData(string $answer, string $category, string $query = ''): string
    {
        $siteSettings = Setting::first();

        // 1. Live Account & Donation info
        if ($category === 'donations' || str_contains($query, 'দান') || str_contains($query, 'টাকা') || str_contains($query, 'বিকাশ')) {
            if ($siteSettings) {
                $extra = "\n\n📌 সরাসরি একাউন্ট বিবরণ (লাইভ তথ্য):";
                if (!empty($siteSettings->bkash_number)) {
                    $extra .= "\n• বিকাশ ({$siteSettings->bkash_type}): {$siteSettings->bkash_number}";
                }
                if (!empty($siteSettings->nagad_number)) {
                    $extra .= "\n• নগদ ({$siteSettings->nagad_type}): {$siteSettings->nagad_number}";
                }
                if (!empty($siteSettings->bank_account_number)) {
                    $extra .= "\n• ব্যাংক: {$siteSettings->bank_name}, হিসাব নং: {$siteSettings->bank_account_number}";
                }
                $answer .= $extra;
            }
        } 
        
        // 2. Live Contact info
        if ($category === 'contact' || str_contains($query, 'ঠিকানা') || str_contains($query, 'ফোন')) {
            if ($siteSettings) {
                $extra = "\n\n📌 কেন্দ্রীয় কার্যালয় যোগাযোগ তথ্য:";
                if (!empty($siteSettings->contact_phone)) {
                    $extra .= "\n• হেল্পলাইন: {$siteSettings->contact_phone}";
                }
                if (!empty($siteSettings->contact_email)) {
                    $extra .= "\n• ইমেইল: {$siteSettings->contact_email}";
                }
                if (!empty($siteSettings->contact_address)) {
                    $extra .= "\n• কার্যালয়: {$siteSettings->contact_address}";
                }
                $answer .= $extra;
            }
        }

        // 3. Dynamic Leadership Match if query mentions a district or area
        if (!empty($query)) {
            $words = preg_split('/[\s,?.!;:()"\']+/u', $query, -1, PREG_SPLIT_NO_EMPTY);
            $matchedLeaders = [];
            foreach ($words as $word) {
                if (mb_strlen($word, 'UTF-8') >= 3 && !in_array($word, ['দায়িত্বশীল', 'সভাপতি', 'কমিটি', 'কারা', 'আছে'])) {
                    $leaders = Management::where('area', 'like', "%{$word}%")
                        ->orWhere('name', 'like', "%{$word}%")
                        ->take(4)
                        ->get();
                    foreach ($leaders as $ld) {
                        $matchedLeaders[] = "• {$ld->area}: {$ld->name} ({$ld->designation})" . ($ld->phone ? ", ফোন: {$ld->phone}" : "");
                    }
                }
            }
            if (!empty($matchedLeaders)) {
                $answer .= "\n\n📌 আপনার এলাকার দায়িত্বশীলদের তালিকা:\n" . implode("\n", array_unique($matchedLeaders));
            }
        }

        return $answer;
    }

    /**
     * Build rich, live site context from Knowledge Base and actual Database records for LLMs.
     */
    protected function buildDynamicSiteContext(string $prompt): string
    {
        $context = "=== শুভ্বান অফিশিয়াল ওয়েবসাইট রিয়েলটাইম ফ্যাক্টস ও তথ্যসূত্র ===\n";
        $context .= "সংগঠন: জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ (Shubban)\n";
        $context .= "আদর্শ: পবিত্র কুরআন ও সহীহ সুন্নাহর নির্ভেজাল অনুসরণ, শিরক-বিদআত বর্জন।\n";
        $context .= "কেন্দ্রীয় কার্যালয়: ৭৯/ক/৩, উত্তর যাত্রাবাড়ী, ঢাকা-১২০৪। হেল্পলাইন: +৮৮০১৭৬৫-৮১২২৬১।\n";
        $context .= "৪টি প্রশিক্ষণ স্তর: আরেফ (স্তর ১), সালেহ (স্তর ২), রাগেব (স্তর ৩), সালেক (স্তর ৪)।\n";
        $context .= "৪টি বিশেষ অঙ্গ-প্রতিষ্ঠান: শুব্বান রিসার্চ সেন্টার (ফতোয়া), শেকড় (সুস্থ সংস্কৃতি), আস-শিফা (ফ্রি চিকিৎসা ও রক্তদান), মাকতাবাতুশ শুব্বান (বই ও প্রকাশনা)।\n";
        $context .= "ওয়েব ইউআরএল: /donate (অনলাইন দান), /publications/books (বই সম্ভার), /responsible/district (জেলা দায়িত্বশীল), /responsible/upazila (উপজেলা দায়িত্বশীল), /training/aref/register (আরেফ কোর্স রেজিস্ট্রেশন), /contact (যোগাযোগ)।\n\n";

        // Fetch Live Accounts & Helpline from Settings
        try {
            $siteSettings = Setting::first();
            if ($siteSettings) {
                $context .= "লাইভ পেমেন্ট ও একাউন্ট তথ্য:\n";
                if (!empty($siteSettings->bkash_number)) {
                    $context .= "- বিকাশ ({$siteSettings->bkash_type}): {$siteSettings->bkash_number}\n";
                }
                if (!empty($siteSettings->nagad_number)) {
                    $context .= "- নগদ ({$siteSettings->nagad_type}): {$siteSettings->nagad_number}\n";
                }
                if (!empty($siteSettings->bank_account_number)) {
                    $context .= "- ব্যাংক: {$siteSettings->bank_name}, হিসাব নং: {$siteSettings->bank_account_number}\n";
                }
            }
        } catch (\Throwable $e) {}

        // Match leaders if user asked about area or leader
        try {
            $words = preg_split('/[\s,?.!;:()"\']+/u', $prompt, -1, PREG_SPLIT_NO_EMPTY);
            $areaMatches = [];
            foreach ($words as $word) {
                if (mb_strlen($word, 'UTF-8') >= 3) {
                    $found = Management::where('area', 'like', "%{$word}%")
                        ->orWhere('name', 'like', "%{$word}%")
                        ->take(4)
                        ->get(['name', 'designation', 'area', 'phone']);
                    foreach ($found as $f) {
                        $areaMatches[] = "- {$f->area}: {$f->name} ({$f->designation}, ফোন: {$f->phone})";
                    }
                }
            }
            if (!empty($areaMatches)) {
                $context .= "\nসংশ্লিষ্ট দায়িত্বশীলদের তথ্য:\n" . implode("\n", array_unique($areaMatches)) . "\n";
            }
        } catch (\Throwable $e) {}

        // Recent Top Knowledge Base items
        try {
            $topKnowledge = AIChatKnowledgeBase::active()->orderByDesc('priority')->take(12)->get();
            $context .= "\nপ্রশ্নোত্তর নলেজ বেস:\n";
            foreach ($topKnowledge as $kb) {
                $context .= "- প্রশ্ন: {$kb->question} | উত্তর: " . Str::limit($kb->answer, 200) . "\n";
            }
        } catch (\Throwable $e) {}

        return $context;
    }

    /**
     * Call Google Gemini API (v1beta / Free Tier) using HTTP client.
     */
    protected function callGeminiApi(string $prompt, AIChatSetting $setting): ?string
    {
        try {
            $apiKey = trim($setting->api_key ?: env('GEMINI_API_KEY', ''));
            if (empty($apiKey)) {
                return null;
            }

            $model = $setting->model_name ?: 'gemini-1.5-flash';
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            $systemPrompt = $setting->system_prompt ?: "You are Shubban AI Assistant. Answer questions politely in Bengali based on official organizational facts.";
            $dynamicContext = $this->buildDynamicSiteContext($prompt);

            $response = Http::timeout(14)->post($url, [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $systemPrompt . "\n\n" . $dynamicContext]
                    ]
                ],
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => (float) ($setting->temperature ?? 0.7),
                    'maxOutputTokens' => 800,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                if (!empty($text)) {
                    return trim($text);
                }
            } else {
                // Older API fallback without system_instruction structure
                $fallbackResponse = Http::timeout(14)->post($url, [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $systemPrompt . "\n\nContext:\n" . $dynamicContext . "\n\nUser Question:\n" . $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => (float) ($setting->temperature ?? 0.7),
                        'maxOutputTokens' => 800,
                    ]
                ]);

                if ($fallbackResponse->successful()) {
                    $fallbackData = $fallbackResponse->json();
                    $text = $fallbackData['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if (!empty($text)) {
                        return trim($text);
                    }
                }

                Log::warning('Gemini API Error: ' . $response->body());
            }
        } catch (\Throwable $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Call Groq Cloud AI API (Ultra-Fast Free Tier - Llama 3.3 70B / Llama 3.1 8B).
     */
    protected function callGroqApi(string $prompt, AIChatSetting $setting): ?string
    {
        try {
            $apiKey = trim($setting->api_key ?: env('GROQ_API_KEY', ''));
            if (empty($apiKey)) {
                return null;
            }

            $model = $setting->model_name ?: 'llama-3.3-70b-versatile';
            $url = "https://api.groq.com/openai/v1/chat/completions";

            $systemPrompt = $setting->system_prompt ?: "You are Shubban AI Assistant. Answer questions politely in Bengali based on official organizational facts.";
            $dynamicContext = $this->buildDynamicSiteContext($prompt);

            $response = Http::timeout(14)
                ->withToken($apiKey)
                ->post($url, [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt . "\n\n" . $dynamicContext],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => (float) ($setting->temperature ?? 0.7),
                    'max_tokens' => 800,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['choices'][0]['message']['content'] ?? null;
                if (!empty($text)) {
                    return trim($text);
                }
            } else {
                Log::warning('Groq API Error: ' . $response->body());
            }
        } catch (\Throwable $e) {
            Log::error('Groq API Exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Call OpenAI Chat Completion API.
     */
    protected function callOpenAIApi(string $prompt, AIChatSetting $setting): ?string
    {
        try {
            $apiKey = trim($setting->api_key ?: env('OPENAI_API_KEY', ''));
            if (empty($apiKey)) {
                return null;
            }

            $model = $setting->model_name ?: 'gpt-4o-mini';
            $url = "https://api.openai.com/v1/chat/completions";

            $systemPrompt = $setting->system_prompt ?: "You are Shubban AI Assistant. Answer questions politely in Bengali.";
            $dynamicContext = $this->buildDynamicSiteContext($prompt);

            $response = Http::timeout(14)->withToken($apiKey)->post($url, [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt . "\n\n" . $dynamicContext],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => (float) ($setting->temperature ?? 0.7),
                'max_tokens' => 800,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['choices'][0]['message']['content'] ?? null;
                if (!empty($text)) {
                    return trim($text);
                }
            } else {
                Log::warning('OpenAI API Error: ' . $response->body());
            }
        } catch (\Throwable $e) {
            Log::error('OpenAI API Exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Search site database for matching leadership, books, notices, and activities.
     */
    protected function searchSiteContent(string $query): ?string
    {
        $words = preg_split('/\s+/u', trim($query), -1, PREG_SPLIT_NO_EMPTY);
        $firstWord = $words[0] ?? '';
        if (mb_strlen($firstWord, 'UTF-8') < 2) {
            return null;
        }

        // 1. Search Leadership
        $leaders = Management::where('area', 'like', "%{$firstWord}%")
            ->orWhere('name', 'like', "%{$firstWord}%")
            ->take(3)
            ->get();

        // 2. Search Books
        $books = Book::where('title', 'like', "%{$firstWord}%")
            ->orWhere('author', 'like', "%{$firstWord}%")
            ->take(2)
            ->get();

        // 3. Search Notices
        $notices = Notice::where('title', 'like', "%{$firstWord}%")
            ->take(2)
            ->get();

        if ($leaders->isNotEmpty() || $books->isNotEmpty() || $notices->isNotEmpty()) {
            $reply = "আপনার অনুসন্ধান সম্পর্কিত কিছু অফিশিয়াল তথ্য পাওয়া গেছে:\n";

            if ($leaders->isNotEmpty()) {
                $reply .= "\n👥 দায়িত্বশীলবৃন্দ:\n";
                foreach ($leaders as $l) {
                    $reply .= "• {$l->area}: {$l->name} ({$l->designation})" . ($l->phone ? " - ফোন: {$l->phone}" : "") . "\n";
                }
            }

            if ($books->isNotEmpty()) {
                $reply .= "\n📖 কিতাব ও প্রকাশনা:\n";
                foreach ($books as $b) {
                    $reply .= "• \"{$b->title}\" (ওয়েবসাইটের 'প্রকাশনা' মেনুতে বিস্তারিত দেখুন)\n";
                }
            }

            if ($notices->isNotEmpty()) {
                $reply .= "\n📢 নোটিশ ও বিজ্ঞপ্তি:\n";
                foreach ($notices as $n) {
                    $reply .= "• \"{$n->title}\" (ডিজিটাল নোটিশ বোর্ডে বিস্তারিত দেখুন)\n";
                }
            }

            $reply .= "\nআরও বিস্তারিত তথ্যের জন্য মূল মেনুর সংশ্লিষ্ট পেজটি ভিজিট করুন।";
            return $reply;
        }

        return null;
    }

    /**
     * Record visitor feedback.
     */
    public function recordFeedback(int $messageId, bool $wasHelpful): bool
    {
        $message = AIChatMessage::find($messageId);
        if ($message) {
            $message->was_helpful = $wasHelpful;
            $message->save();
            return true;
        }
        return false;
    }
}
