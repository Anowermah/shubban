<?php

namespace App\Services;

use App\Models\AIChatSetting;
use App\Models\AIChatKnowledgeBase;
use App\Models\AIChatMessage;
use App\Models\Setting;
use App\Models\Notice;
use App\Models\Activity;
use App\Models\Book;
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

            $reply = $this->enrichAnswerWithLiveData($matchedKb->answer, $matchedKb->category);

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

        // 3. If no Knowledge Base match, try External LLM (Gemini or OpenAI) if configured
        if (!empty($setting->api_key)) {
            if ($setting->ai_provider === 'gemini') {
                $llmReply = $this->callGeminiApi($userMessage, $setting);
                if ($llmReply) {
                    $log = AIChatMessage::create([
                        'session_id' => $sessionId,
                        'user_ip' => $userIp,
                        'user_message' => $userMessage,
                        'bot_response' => $llmReply,
                        'provider_used' => 'gemini',
                        'matched_knowledge_id' => null,
                        'is_resolved' => true,
                    ]);

                    return [
                        'success' => true,
                        'reply' => $llmReply,
                        'provider' => 'gemini',
                        'message_id' => $log->id,
                    ];
                }
            } elseif ($setting->ai_provider === 'openai') {
                $llmReply = $this->callOpenAIApi($userMessage, $setting);
                if ($llmReply) {
                    $log = AIChatMessage::create([
                        'session_id' => $sessionId,
                        'user_ip' => $userIp,
                        'user_message' => $userMessage,
                        'bot_response' => $llmReply,
                        'provider_used' => 'openai',
                        'matched_knowledge_id' => null,
                        'is_resolved' => true,
                    ]);

                    return [
                        'success' => true,
                        'reply' => $llmReply,
                        'provider' => 'openai',
                        'message_id' => $log->id,
                    ];
                }
            }
        }

        // 4. Smart Site Search Fallback (Searching Book, Notice, Activity titles)
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
     * Enrich answer with actual live data from Settings model (Accounts, Phone, Address).
     */
    protected function enrichAnswerWithLiveData(string $answer, string $category): string
    {
        $siteSettings = Setting::first();
        if (!$siteSettings) {
            return $answer;
        }

        if ($category === 'donations') {
            $extra = "\n\n📌 সরাসরি একাউন্ট বিবরণ:";
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
        } elseif ($category === 'contact') {
            $extra = "\n\n📌 সরাসরি যোগাযোগ তথ্য:";
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

        return $answer;
    }

    /**
     * Call Google Gemini API (v1beta) using HTTP client.
     */
    protected function callGeminiApi(string $prompt, AIChatSetting $setting): ?string
    {
        try {
            $apiKey = trim($setting->api_key);
            $model = $setting->model_name ?: 'gemini-1.5-flash';
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            $systemPrompt = $setting->system_prompt ?: "You are Shubban AI Assistant. Answer questions politely in Bengali.";

            // Load brief knowledge context for RAG
            $topKnowledge = AIChatKnowledgeBase::active()->orderByDesc('priority')->take(10)->get();
            $knowledgeContext = "Organization Facts:\n";
            foreach ($topKnowledge as $kb) {
                $knowledgeContext .= "- Q: {$kb->question} | A: " . Str::limit($kb->answer, 180) . "\n";
            }

            $response = Http::timeout(12)->post($url, [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $systemPrompt . "\n\n" . $knowledgeContext]
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
                    'temperature' => (float) $setting->temperature,
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
                Log::warning('Gemini API Error: ' . $response->body());
            }
        } catch (\Throwable $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Call OpenAI Chat Completion API.
     */
    protected function callOpenAIApi(string $prompt, AIChatSetting $setting): ?string
    {
        try {
            $apiKey = trim($setting->api_key);
            $model = $setting->model_name ?: 'gpt-4o-mini';
            $url = "https://api.openai.com/v1/chat/completions";

            $systemPrompt = $setting->system_prompt ?: "You are Shubban AI Assistant. Answer questions politely in Bengali.";

            $response = Http::timeout(12)->withToken($apiKey)->post($url, [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => (float) $setting->temperature,
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
     * Search site database for matching articles, books, notices.
     */
    protected function searchSiteContent(string $query): ?string
    {
        $words = preg_split('/\s+/u', trim($query), -1, PREG_SPLIT_NO_EMPTY);
        $firstWord = $words[0] ?? '';
        if (mb_strlen($firstWord, 'UTF-8') < 3) {
            return null;
        }

        $books = Book::where('title', 'like', "%{$firstWord}%")->take(2)->get();
        $notices = Notice::where('title', 'like', "%{$firstWord}%")->take(2)->get();

        if ($books->isNotEmpty() || $notices->isNotEmpty()) {
            $reply = "আপনার অনুসন্ধান সম্পর্কিত কিছু তথ্য ওয়েবসাইটে রয়েছে:\n";
            foreach ($books as $b) {
                $reply .= "• কিতাব: \"{$b->title}\" (প্রকাশনা সেকশনে বিস্তারিত দেখুন)\n";
            }
            foreach ($notices as $n) {
                $reply .= "• নোটিশ: \"{$n->title}\" (ডিজিটাল নোটিশ বোর্ডে দেখুন)\n";
            }
            $reply .= "\nআরও বিস্তারিত জানতে মূল মেনুর সংশ্লিষ্ট পেইজটি ভিজিট করুন।";
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
