<?php

use App\Models\AIChatKnowledgeBase;
use App\Models\AIChatSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Seed or Update Knowledge Base with all 45+ rich organization Q&As
        if (Schema::hasTable('ai_chat_knowledge_bases')) {
            $items = AIChatKnowledgeBase::defaultKnowledgeItems();
            foreach ($items as $item) {
                AIChatKnowledgeBase::updateOrCreate(
                    [
                        'question' => $item['question'],
                    ],
                    [
                        'category' => $item['category'],
                        'keywords' => $item['keywords'],
                        'answer' => $item['answer'],
                        'priority' => $item['priority'],
                        'is_active' => true,
                    ]
                );
            }
        }

        // 2. Ensure default AIChatSetting exists with optimal defaults
        if (Schema::hasTable('ai_chat_settings')) {
            $setting = AIChatSetting::first();
            if ($setting) {
                if (empty($setting->quick_prompts) || count($setting->quick_prompts) < 4) {
                    $setting->quick_prompts = AIChatSetting::defaultQuickPrompts();
                    $setting->save();
                }
            } else {
                AIChatSetting::create(AIChatSetting::defaultSettings());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down needed for knowledge enrichment
    }
};
