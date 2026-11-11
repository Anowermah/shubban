<?php

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
        // 1. AI Chat Settings Table
        if (!Schema::hasTable('ai_chat_settings')) {
            Schema::create('ai_chat_settings', function (Blueprint $table) {
                $table->id();
                $table->boolean('is_enabled')->default(true);
                $table->string('bot_name')->default('শুব্বান এআই সহকারী');
                $table->string('bot_subtitle')->default('২৪/৭ অনলাইন তথ্য ও দিকনির্দেশনা');
                $table->text('welcome_message')->nullable();
                $table->text('fallback_message')->nullable();
                $table->text('system_prompt')->nullable();
                $table->string('ai_provider')->default('internal'); // internal, gemini, openai
                $table->text('api_key')->nullable();
                $table->string('model_name')->default('gemini-1.5-flash');
                $table->float('temperature')->default(0.7);
                $table->boolean('enable_floating_widget')->default(true);
                $table->string('widget_position')->default('bottom-right'); // bottom-right, bottom-left
                $table->json('quick_prompts')->nullable();
                $table->timestamps();
            });
        }

        // 2. AI Chat Knowledge Base (Q&A Repository)
        if (!Schema::hasTable('ai_chat_knowledge_bases')) {
            Schema::create('ai_chat_knowledge_bases', function (Blueprint $table) {
                $table->id();
                $table->string('category')->default('general'); // general, about, training, facilities, donations, publications, contact, islamic
                $table->string('question');
                $table->text('keywords')->nullable(); // comma-separated search terms
                $table->longText('answer');
                $table->integer('priority')->default(0);
                $table->boolean('is_active')->default(true);
                $table->unsignedBigInteger('hit_count')->default(0);
                $table->timestamps();
            });
        }

        // 3. AI Chat Conversation / Interaction Logs
        if (!Schema::hasTable('ai_chat_messages')) {
            Schema::create('ai_chat_messages', function (Blueprint $table) {
                $table->id();
                $table->string('session_id')->index();
                $table->string('user_ip', 45)->nullable();
                $table->text('user_message');
                $table->longText('bot_response');
                $table->string('provider_used')->default('internal');
                $table->unsignedBigInteger('matched_knowledge_id')->nullable();
                $table->boolean('was_helpful')->nullable(); // true for thumbs up, false for thumbs down
                $table->boolean('is_resolved')->default(true);
                $table->timestamps();

                $table->foreign('matched_knowledge_id')
                      ->references('id')
                      ->on('ai_chat_knowledge_bases')
                      ->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_chat_messages');
        Schema::dropIfExists('ai_chat_knowledge_bases');
        Schema::dropIfExists('ai_chat_settings');
    }
};
