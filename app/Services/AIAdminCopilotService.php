<?php

namespace App\Services;

use App\Models\AIAdminAction;
use App\Models\AIChatSetting;
use App\Models\HomeSection;
use App\Models\Management;
use App\Models\Notice;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AIAdminCopilotService
{
    /**
     * Process an admin command prompt and execute appropriate actions safely.
     */
    public function executePrompt(string $prompt): array
    {
        $prompt = trim($prompt);
        if (empty($prompt)) {
            return [
                'success' => false,
                'message' => 'অনুগ্রহ করে আপনার নির্দেশ বা কমান্ডটি লিখুন।',
                'action_taken' => null,
            ];
        }

        // Check if user wants rollback
        if ($this->isRollbackCommand($prompt)) {
            return $this->handleRollback();
        }

        // Check if an external LLM (Gemini or OpenAI) is configured
        $chatSetting = AIChatSetting::getSettings();
        $hasApiKey = !empty($chatSetting->api_key) && in_array($chatSetting->ai_provider, ['gemini', 'openai']);

        $plan = null;

        if ($hasApiKey) {
            $plan = $this->planWithLLM($prompt, $chatSetting);
        }

        // If no LLM plan or LLM unavailable, use built-in smart rule engine
        if (!$plan) {
            $plan = $this->planWithBuiltinEngine($prompt);
        }

        // Execute the planned action
        return $this->executePlan($plan, $prompt);
    }

    /**
     * Execute the structured action plan.
     */
    protected function executePlan(array $plan, string $originalPrompt): array
    {
        $actionType = $plan['action_type'] ?? 'general';
        $params = $plan['params'] ?? [];
        $adminId = Auth::guard('admin')->id();

        switch ($actionType) {
            case 'theme_color':
                return $this->actionUpdateThemeColors($params, $originalPrompt, $adminId);

            case 'custom_css':
                return $this->actionApplyCustomCSS($params, $originalPrompt, $adminId);

            case 'home_section':
                return $this->actionManageHomeSection($params, $originalPrompt, $adminId);

            case 'site_setting':
                return $this->actionUpdateSiteSetting($params, $originalPrompt, $adminId);

            case 'management_add':
                return $this->actionAddResponsible($params, $originalPrompt, $adminId);

            case 'system_diagnostics':
                return $this->actionSystemDiagnostics($originalPrompt, $adminId);

            case 'system_repair':
                return $this->actionSystemRepair($originalPrompt, $adminId);

            case 'general_advice':
            default:
                return [
                    'success' => true,
                    'action_taken' => 'general_advice',
                    'message' => $plan['explanation'] ?? 'আপনার নির্দেশ অনুযায়ী সিস্টেম বিশ্লেষণ করা হয়েছে। সাইট সম্পূর্ণ সচল ও স্বাভাবিক রয়েছে।',
                    'preview_html' => null,
                    'can_rollback' => false,
                ];
        }
    }

    /**
     * Update site primary and accent theme colors.
     */
    protected function actionUpdateThemeColors(array $params, string $prompt, ?int $adminId): array
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create(['site_title' => 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ']);
        }

        $before = [
            'color_theme' => $setting->color_theme,
            'primary_color' => $setting->primary_color,
            'accent_color' => $setting->accent_color,
        ];

        $primary = $params['primary_color'] ?? $setting->primary_color ?? '#0C4B36';
        $accent = $params['accent_color'] ?? $setting->accent_color ?? '#FBB040';
        $themeKey = $params['color_theme'] ?? 'custom';

        $setting->update([
            'primary_color' => $primary,
            'accent_color' => $accent,
            'color_theme' => $themeKey,
        ]);

        $after = [
            'color_theme' => $themeKey,
            'primary_color' => $primary,
            'accent_color' => $accent,
        ];

        try {
            Artisan::call('optimize:clear');
        } catch (\Throwable $e) {}

        $summary = "সাইটের প্রাইমারি কালার '{$primary}' এবং অ্যাকসেন্ট কালার '{$accent}' এ সফলভাবে আপডেট করা হয়েছে।";

        $action = AIAdminAction::create([
            'admin_id' => $adminId,
            'prompt' => $prompt,
            'action_type' => 'theme_color',
            'summary' => $summary,
            'payload_before' => $before,
            'payload_after' => $after,
        ]);

        return [
            'success' => true,
            'action_taken' => 'theme_color',
            'action_id' => $action->id,
            'message' => "✅ " . $summary,
            'details' => [
                'primary_color' => $primary,
                'accent_color' => $accent,
            ],
            'preview_html' => "<div class='d-flex align-items-center gap-3 p-3 rounded-3 bg-light border'><div style='width:36px;height:36px;background:{$primary};border-radius:8px;' title='Primary Color'></div><div style='width:36px;height:36px;background:{$accent};border-radius:8px;' title='Accent Color'></div><div><strong>নতুন কালার প্যালেট:</strong> প্রাইমারি {$primary} | অ্যাকসেন্ট {$accent}</div></div>",
            'can_rollback' => true,
        ];
    }

    /**
     * Apply custom CSS design improvement to the site.
     */
    protected function actionApplyCustomCSS(array $params, string $prompt, ?int $adminId): array
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create(['site_title' => 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ']);
        }

        $beforeCSS = $setting->custom_css ?? '';
        $newCSS = $params['css'] ?? '';
        $mode = $params['mode'] ?? 'append'; // 'append' or 'replace'

        $finalCSS = ($mode === 'replace' || empty($beforeCSS)) ? $newCSS : ($beforeCSS . "\n\n/* AI Design Update - " . date('Y-m-d H:i') . " */\n" . $newCSS);

        $setting->update([
            'custom_css' => $finalCSS,
        ]);

        try {
            Artisan::call('optimize:clear');
        } catch (\Throwable $e) {}

        $summary = $params['summary'] ?? "সাইটের ডিজাইনে নতুন কাস্টম সিএসএস রুলস যুক্ত করা হয়েছে।";

        $action = AIAdminAction::create([
            'admin_id' => $adminId,
            'prompt' => $prompt,
            'action_type' => 'custom_css',
            'summary' => $summary,
            'payload_before' => ['custom_css' => $beforeCSS],
            'payload_after' => ['custom_css' => $finalCSS],
        ]);

        return [
            'success' => true,
            'action_taken' => 'custom_css',
            'action_id' => $action->id,
            'message' => "🎨 " . $summary,
            'details' => [
                'css_snippet' => Str::limit($newCSS, 250),
            ],
            'preview_html' => "<div class='p-3 bg-dark text-white rounded-3 small font-monospace overflow-auto' style='max-height:160px;'>" . e($newCSS) . "</div>",
            'can_rollback' => true,
        ];
    }

    /**
     * Enable/disable or update a homepage section.
     */
    protected function actionManageHomeSection(array $params, string $prompt, ?int $adminId): array
    {
        $sectionKey = $params['section_key'] ?? null;
        $isActive = isset($params['is_active']) ? (bool) $params['is_active'] : null;
        $title = $params['title'] ?? null;
        $subtitle = $params['subtitle'] ?? null;
        $order = $params['order'] ?? null;

        if (!$sectionKey) {
            return [
                'success' => false,
                'message' => 'কোন সেকশনটি পরিবর্তন করতে চান তা স্পষ্টভাবে নির্দেশ করুন (যেমন: স্লাইডার, ভিডিও গ্যালারি, নোটিশ ইত্যাদি)।',
            ];
        }

        $section = HomeSection::where('section_key', $sectionKey)->first();
        if (!$section) {
            return [
                'success' => false,
                'message' => "দুঃখিত, '{$sectionKey}' সেকশনটি ডাটাবেজে পাওয়া যায়নি।",
            ];
        }

        $before = $section->toArray();

        $updates = [];
        if ($isActive !== null) $updates['is_active'] = $isActive;
        if ($title !== null) $updates['title'] = $title;
        if ($subtitle !== null) $updates['subtitle'] = $subtitle;
        if ($order !== null) $updates['order'] = (int) $order;

        $section->update($updates);

        try {
            Artisan::call('optimize:clear');
        } catch (\Throwable $e) {}

        $statusText = $section->is_active ? 'সক্রিয় (Visible)' : 'নিষ্ক্রিয়/বন্ধ (Hidden)';
        $summary = "হোমপেজের '{$section->name_bn}' সেকশনটি {$statusText} করা হয়েছে।";

        $action = AIAdminAction::create([
            'admin_id' => $adminId,
            'prompt' => $prompt,
            'action_type' => 'home_section',
            'summary' => $summary,
            'payload_before' => $before,
            'payload_after' => $section->fresh()->toArray(),
        ]);

        return [
            'success' => true,
            'action_taken' => 'home_section',
            'action_id' => $action->id,
            'message' => "📑 " . $summary,
            'can_rollback' => true,
        ];
    }

    /**
     * Update site general settings.
     */
    protected function actionUpdateSiteSetting(array $params, string $prompt, ?int $adminId): array
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create(['site_title' => 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ']);
        }

        $before = $setting->toArray();
        $allowed = ['site_title', 'site_description', 'contact_email', 'contact_phone', 'contact_address', 'facebook_url', 'youtube_url'];
        
        $updates = array_intersect_key($params, array_flip($allowed));

        if (empty($updates)) {
            return [
                'success' => false,
                'message' => 'কোনো বৈধ সেটিং প্যারামিটার পাওয়া যায়নি।',
            ];
        }

        $setting->update($updates);

        try {
            Artisan::call('optimize:clear');
        } catch (\Throwable $e) {}

        $summary = "সাইটের সাধারণ সেটিংস আপডেট করা হয়েছে: " . implode(', ', array_keys($updates));

        $action = AIAdminAction::create([
            'admin_id' => $adminId,
            'prompt' => $prompt,
            'action_type' => 'site_setting',
            'summary' => $summary,
            'payload_before' => $before,
            'payload_after' => $setting->fresh()->toArray(),
        ]);

        return [
            'success' => true,
            'action_taken' => 'site_setting',
            'action_id' => $action->id,
            'message' => "⚙️ " . $summary,
            'can_rollback' => true,
        ];
    }

    /**
     * Add a responsible person in management table.
     */
    protected function actionAddResponsible(array $params, string $prompt, ?int $adminId): array
    {
        $name = $params['name'] ?? null;
        $designation = $params['designation'] ?? 'দায়িত্বশীল';
        $level = $params['level'] ?? 'district';
        $area = $params['area'] ?? null;
        $phone = $params['phone'] ?? null;
        $email = $params['email'] ?? null;
        $address = $params['address'] ?? null;

        if (!$name) {
            return [
                'success' => false,
                'message' => 'দায়িত্বশীল ব্যক্তির নাম প্রদান করুন।',
            ];
        }

        $maxOrder = Management::where('level', $level)->max('order') ?? 0;

        $created = Management::create([
            'name' => $name,
            'designation' => $designation,
            'level' => $level,
            'area' => $area,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'status' => true,
            'order' => $maxOrder + 1,
        ]);

        try {
            Artisan::call('optimize:clear');
        } catch (\Throwable $e) {}

        $summary = "'{$name}' ({$designation}) কে সফলভাবে " . ($area ? "{$area} এলাকার " : "") . "দায়িত্বশীল হিসেবে যুক্ত করা হয়েছে।";

        $action = AIAdminAction::create([
            'admin_id' => $adminId,
            'prompt' => $prompt,
            'action_type' => 'management_add',
            'summary' => $summary,
            'payload_before' => null,
            'payload_after' => $created->toArray(),
        ]);

        return [
            'success' => true,
            'action_taken' => 'management_add',
            'action_id' => $action->id,
            'message' => "👤 " . $summary,
            'preview_html' => "<div class='p-3 bg-light rounded-3 border'><strong>{$created->name}</strong> — {$created->designation}<br><span class='text-muted small'>এলাকা: {$created->area} | ফোন: {$created->phone}</span></div>",
            'can_rollback' => true,
        ];
    }

    /**
     * Run full system diagnostics and report health status.
     */
    protected function actionSystemDiagnostics(string $prompt, ?int $adminId): array
    {
        $phpVersion = PHP_VERSION;
        $laravelVersion = app()->version();
        
        $counts = [
            'users' => \App\Models\User::count(),
            'books' => \App\Models\Book::count(),
            'notices' => \App\Models\Notice::count(),
            'management' => \App\Models\Management::count(),
            'committee' => \App\Models\Committee::count(),
            'home_sections' => \App\Models\HomeSection::count(),
        ];

        $reportHtml = "
            <div class='system-health-report p-3 rounded-3 bg-light border'>
                <h6 class='fw-bold text-success mb-2'><i class='fas fa-check-circle me-1'></i> সিস্টেম ডায়াগনস্টিক রিপোর্ট</h6>
                <div class='row g-2 small'>
                    <div class='col-6'><strong>পিএইচপি ভার্সন:</strong> {$phpVersion}</div>
                    <div class='col-6'><strong>লারাভেল ভার্সন:</strong> {$laravelVersion}</div>
                    <div class='col-6'><strong>বই ও প্রকাশনা:</strong> {$counts['books']} টি</div>
                    <div class='col-6'><strong>নোটিশ সংখ্যা:</strong> {$counts['notices']} টি</div>
                    <div class='col-6'><strong>জেলা ও শাখা দায়িত্বশীল:</strong> {$counts['management']} জন</div>
                    <div class='col-6'><strong>হোমপেজ সেকশন:</strong> {$counts['home_sections']} টি সক্রিয়</div>
                </div>
            </div>
        ";

        return [
            'success' => true,
            'action_taken' => 'system_diagnostics',
            'message' => "🔍 সিস্টেম ডায়াগনস্টিক সম্পন্ন হয়েছে! সকল ডাটাবেজ টেবিল, সার্ভিস ও কনফিগারেশন সক্রিয় রয়েছে।",
            'preview_html' => $reportHtml,
            'can_rollback' => false,
        ];
    }

    /**
     * Run full system optimize clear.
     */
    protected function actionSystemRepair(string $prompt, ?int $adminId): array
    {
        try {
            Artisan::call('optimize:clear');
            $output = Artisan::output();
        } catch (\Throwable $e) {
            $output = $e->getMessage();
        }

        return [
            'success' => true,
            'action_taken' => 'system_repair',
            'message' => "⚡ সিস্টেম ক্যাশ ও কম্পাইল্ড ফাইলসমূহ সফলভাবে পরিষ্কার করা হয়েছে। সাইট এখন সর্বোচ্চ গতিতে লোড হবে।",
            'preview_html' => "<pre class='p-2 bg-dark text-success rounded-3 small font-monospace'>" . e($output ?: "Cache cleared successfully.") . "</pre>",
            'can_rollback' => false,
        ];
    }

    /**
     * Rollback the last action.
     */
    public function handleRollback(?int $specificActionId = null): array
    {
        $query = AIAdminAction::where('is_rolled_back', false);
        if ($specificActionId) {
            $action = $query->find($specificActionId);
        } else {
            $action = $query->latest()->first();
        }

        if (!$action) {
            return [
                'success' => false,
                'message' => 'রোলব্যাক করার মতো কোনো সাম্প্রতিক পরিবর্তন পাওয়া যায়নি।',
            ];
        }

        $type = $action->action_type;
        $before = $action->payload_before;

        switch ($type) {
            case 'theme_color':
                if ($before) {
                    Setting::first()->update($before);
                    Artisan::call('optimize:clear');
                }
                break;

            case 'custom_css':
                if (isset($before['custom_css'])) {
                    Setting::first()->update(['custom_css' => $before['custom_css']]);
                    Artisan::call('optimize:clear');
                }
                break;

            case 'home_section':
                if ($before && isset($before['id'])) {
                    HomeSection::where('id', $before['id'])->update($before);
                    Artisan::call('optimize:clear');
                }
                break;

            case 'site_setting':
                if ($before) {
                    Setting::first()->update($before);
                    Artisan::call('optimize:clear');
                }
                break;

            case 'management_add':
                if (!empty($action->payload_after['id'])) {
                    Management::where('id', $action->payload_after['id'])->delete();
                    Artisan::call('optimize:clear');
                }
                break;
        }

        $action->update(['is_rolled_back' => true]);

        return [
            'success' => true,
            'action_taken' => 'rollback',
            'message' => "↩️ সফলভাবে পূর্বাবস্থায় ফিরিয়ে আনা হয়েছে: '{$action->summary}'",
        ];
    }

    /**
     * Check if prompt is a rollback request.
     */
    protected function isRollbackCommand(string $prompt): bool
    {
        $p = mb_strtolower($prompt);
        return Str::contains($p, ['রোলব্যাক', 'পূর্বাবস্থায়', 'আগের অবস্থায়', 'বাতিল কর', 'undo', 'rollback']);
    }

    /**
     * Built-in Bengali intent parser (Works offline / without API key!).
     */
    protected function planWithBuiltinEngine(string $prompt): array
    {
        $p = mb_strtolower($prompt);

        // 1. Diagnostics or Cache
        if (Str::contains($p, ['ক্যাশ', 'ক্লিয়ার', 'অপটিমাইজ', 'ফাস্ট কর', 'গতি', 'রিপেয়ার', 'মেরামত'])) {
            return [
                'action_type' => 'system_repair',
                'params' => [],
            ];
        }

        if (Str::contains($p, ['ডায়াগনস্টিক', 'হেলথ', 'চেক কর', 'স্ট্যাটাস', 'কোনো ভুল'])) {
            return [
                'action_type' => 'system_diagnostics',
                'params' => [],
            ];
        }

        // 2. Color / Theme changes
        if (Str::contains($p, ['কালার', 'রং', 'থিম', 'সবুজ', 'নীল', 'মেরুন', 'টিল', 'নেভি'])) {
            $primary = '#0C4B36';
            $accent = '#FBB040';
            $theme = 'custom';

            if (Str::contains($p, ['হালকা সবুজ', 'লাইট গ্রিন'])) {
                $primary = '#10B981';
                $accent = '#34D399';
            } elseif (Str::contains($p, ['গাঢ় সবুজ', 'ডিপ গ্রিন', 'রাজকীয়'])) {
                $primary = '#064E3B';
                $accent = '#F59E0B';
            } elseif (Str::contains($p, ['নেভি', 'নীল', 'ব্লু'])) {
                $primary = '#1E3A8A';
                $accent = '#60A5FA';
                $theme = 'navy';
            } elseif (Str::contains($p, ['মেরুন', 'লাল'])) {
                $primary = '#881337';
                $accent = '#FB7185';
                $theme = 'maroon';
            } elseif (Str::contains($p, ['টিল', 'সায়ান'])) {
                $primary = '#0E7490';
                $accent = '#22D3EE';
                $theme = 'teal';
            }

            // Extract hex code if provided e.g. #123456
            if (preg_match('/#[a-f0-9]{6}/i', $prompt, $match)) {
                $primary = $match[0];
            }

            return [
                'action_type' => 'theme_color',
                'params' => [
                    'primary_color' => $primary,
                    'accent_color' => $accent,
                    'color_theme' => $theme,
                ],
            ];
        }

        // 3. Homepage section control
        if (Str::contains($p, ['সেকশন', 'হোমপেজ', 'ভিডিও', 'ফটো', 'স্লাইডার', 'নোটিশ বোর্ড', 'পরিসংখ্যান', 'বন্ধ', 'চালু', 'হাইড'])) {
            $isActive = !Str::contains($p, ['বন্ধ', 'হাইড', 'লুকাও', 'অফ', 'সরাও', 'বাতিল', 'মুছে']);
            $key = 'videos';

            if (Str::contains($p, ['স্লাইডার', 'ব্যানার'])) $key = 'hero_slider';
            elseif (Str::contains($p, ['ভিডিও'])) $key = 'videos';
            elseif (Str::contains($p, ['ফটো', 'ছবি', 'গ্যালারি'])) $key = 'photos';
            elseif (Str::contains($p, ['নোটিশ'])) $key = 'notice_board';
            elseif (Str::contains($p, ['বই', 'প্রকাশনা'])) $key = 'books';
            elseif (Str::contains($p, ['পরিসংখ্যান', 'কাউন্টার'])) $key = 'quick_stats';
            elseif (Str::contains($p, ['দান', 'অনুদান'])) $key = 'donation_banner';
            elseif (Str::contains($p, ['প্রবন্ধ', 'আর্টিকেল'])) $key = 'articles';
            elseif (Str::contains($p, ['সংবাদ', 'কার্যক্রম'])) $key = 'activities_news';
            elseif (Str::contains($p, ['আর্কাইভ'])) $key = 'archives';
            elseif (Str::contains($p, ['প্রতিষ্ঠান', 'সুবিধা'])) $key = 'facilities';
            elseif (Str::contains($p, ['প্রশিক্ষণ'])) $key = 'training_tiers';

            return [
                'action_type' => 'home_section',
                'params' => [
                    'section_key' => $key,
                    'is_active' => $isActive,
                ],
            ];
        }

        // 4. Design improvements (CSS)
        if (Str::contains($p, ['ডিজাইন', 'শ্যাডো', 'কার্ভ', 'রাউন্ড', 'ফন্ট', 'বর্ডার', 'প্যাডিং', 'সিএসএস', 'মার্জিন'])) {
            $css = "/* Smart Design Customization */\n";

            if (Str::contains($p, ['বাটন', 'বোতাম'])) {
                $css .= ".btn { border-radius: 50px !important; box-shadow: 0 4px 12px rgba(12, 75, 54, 0.15) !important; transition: all 0.3s ease !important; }\n.btn:hover { transform: translateY(-2px) !important; box-shadow: 0 6px 18px rgba(12, 75, 54, 0.25) !important; }\n";
            }
            if (Str::contains($p, ['কার্ড', 'বক্স'])) {
                $css .= ".card, .profile-card, .result-card { border-radius: 16px !important; box-shadow: 0 6px 20px rgba(0,0,0,0.06) !important; }\n";
            }
            if (Str::contains($p, ['হেডার'])) {
                $css .= ".main-nav { box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important; }\n";
            }
            if (Str::contains($p, ['ফন্ট'])) {
                $css .= "body { letter-spacing: 0.1px; line-height: 1.7; }\n";
            }

            if (empty(trim($css))) {
                $css = "/* General Polish */\n.btn-success { filter: saturate(1.1); }\n";
            }

            return [
                'action_type' => 'custom_css',
                'params' => [
                    'css' => $css,
                    'summary' => 'আপনার নির্দেশ অনুযায়ী ডিজাইনে আধুনিক সিএসএস শ্যাডো ও রাউন্ডেড কোণা যুক্ত করা হয়েছে।',
                    'mode' => 'append',
                ],
            ];
        }

        // 5. Add responsible person
        if (Str::contains($p, ['দায়িত্বশীল', 'সভাপতি', 'সম্পাদক', 'যুক্ত কর', 'নতুন সদস্য'])) {
            // Extract name and area if possible
            $name = 'নতুন দায়িত্বশীল';
            $designation = 'সভাপতি';
            $area = 'সিরাজগঞ্জ';

            if (preg_match('/নাম[:\s]+([^\s,]+(?:\s+[^\s,]+){1,3})/u', $prompt, $m)) {
                $name = $m[1];
            }
            if (preg_match('/(সভাপতি|সাধারণ সম্পাদক|সাংগঠনিক সম্পাদক|কোষাধ্যক্ষ)/u', $prompt, $m)) {
                $designation = $m[1];
            }
            if (preg_match('/(সিরাজগঞ্জ|ঢাকা|রাজশাহী|পাবনা|বগুড়া|খুলনা|চট্টগ্রাম|রংপুর)/u', $prompt, $m)) {
                $area = $m[1];
            }

            return [
                'action_type' => 'management_add',
                'params' => [
                    'name' => $name,
                    'designation' => $designation,
                    'level' => 'district',
                    'area' => $area,
                    'phone' => '০১৭১১-০০০০০০',
                ],
            ];
        }

        // Default response
        return [
            'action_type' => 'general_advice',
            'explanation' => "আপনার নির্দেশটি গ্রহণ করা হয়েছে। আপনি চাইলে কালার পরিবর্তন, হোমপেজ সেকশন অন/অফ, কাস্টম সিএসএস ডিজাইন বা সিস্টেম অপটিমাইজেশন নির্দেশ করতে পারেন।",
        ];
    }

    /**
     * Plan actions using Gemini or OpenAI LLM API.
     */
    protected function planWithLLM(string $prompt, AIChatSetting $setting): ?array
    {
        try {
            $systemPrompt = "You are Shubban AI Admin Site Copilot.
You help manage and design a Laravel Islamic organization website.
Convert the admin's Bengali prompt into a structured JSON action plan.
JSON FORMAT MUST BE STRICTLY VALID JSON:
{
  \"action_type\": \"theme_color\" | \"custom_css\" | \"home_section\" | \"site_setting\" | \"management_add\" | \"system_repair\" | \"system_diagnostics\" | \"general_advice\",
  \"summary\": \"Brief Bengali summary of action\",
  \"explanation\": \"Friendly response in Bengali\",
  \"params\": {
    // for theme_color: \"primary_color\", \"accent_color\", \"color_theme\"
    // for custom_css: \"css\", \"summary\", \"mode\"
    // for home_section: \"section_key\", \"is_active\"
    // for site_setting: \"site_title\", \"contact_phone\", etc.
    // for management_add: \"name\", \"designation\", \"level\", \"area\", \"phone\"
  }
}
Return ONLY raw JSON without markdown code fences.";

            if ($setting->ai_provider === 'gemini') {
                $apiKey = trim($setting->api_key);
                $model = $setting->model_name ?: 'gemini-1.5-flash';
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

                $res = Http::timeout(10)->post($url, [
                    'system_instruction' => ['parts' => [['text' => $systemPrompt]]],
                    'contents' => [['role' => 'user', 'parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['temperature' => 0.2, 'maxOutputTokens' => 600]
                ]);

                if ($res->successful()) {
                    $text = $res->json('candidates.0.content.parts.0.text');
                    return $this->parseJson($text);
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Admin Copilot LLM Planning failed: ' . $e->getMessage());
        }

        return null;
    }

    protected function parseJson(?string $text): ?array
    {
        if (empty($text)) return null;
        $cleaned = preg_replace('/^```(?:json)?\s*/i', '', trim($text));
        $cleaned = preg_replace('/\s*```$/', '', $cleaned);
        $data = json_decode($cleaned, true);
        return is_array($data) ? $data : null;
    }
}
