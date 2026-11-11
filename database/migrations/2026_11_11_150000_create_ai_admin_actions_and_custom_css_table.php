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
        // 1. Add custom_css to settings table if missing
        if (Schema::hasTable('settings') && !Schema::hasColumn('settings', 'custom_css')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->longText('custom_css')->nullable()->after('enable_theme_switcher');
            });
        }

        // 2. Create ai_admin_actions table
        if (!Schema::hasTable('ai_admin_actions')) {
            Schema::create('ai_admin_actions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->text('prompt');
                $table->string('action_type', 50)->default('general');
                $table->text('summary');
                $table->json('payload_before')->nullable();
                $table->json('payload_after')->nullable();
                $table->boolean('is_rolled_back')->default(false);
                $table->timestamps();

                $table->index('action_type');
                $table->index('is_rolled_back');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_admin_actions');

        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'custom_css')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('custom_css');
            });
        }
    }
};
