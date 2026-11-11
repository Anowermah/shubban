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
        if (!Schema::hasTable('pwa_settings')) {
            Schema::create('pwa_settings', function (Blueprint $table) {
                $table->id();
                $table->boolean('is_enabled')->default(true);
                $table->string('app_name')->default('জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ');
                $table->string('app_short_name')->default('শুব্বান');
                $table->text('app_description')->nullable();
                $table->string('start_url')->default('/?source=pwa');
                $table->string('display_mode')->default('standalone'); // standalone, fullscreen, minimal-ui, browser
                $table->string('orientation')->default('portrait-primary'); // portrait-primary, any, landscape
                $table->string('theme_color')->default('#0C4B36');
                $table->string('background_color')->default('#072e20');
                $table->string('app_icon')->nullable();
                
                // Install Banner Controls
                $table->boolean('enable_install_banner')->default(true);
                $table->string('banner_title')->default('শুব্বান অ্যাপ ইনস্টল করুন');
                $table->string('banner_subtitle')->default('দ্রুত ব্রাউজ ও অফলাইনে পড়ার জন্য');
                $table->string('banner_btn_text')->default('ইনস্টল');
                $table->integer('banner_delay')->default(2); // in seconds
                $table->integer('banner_dismiss_days')->default(7); // in days
                
                // App Shortcuts
                $table->json('shortcuts')->nullable();
                
                // Offline Page Customization
                $table->string('offline_title')->default('আপনি বর্তমানে অফলাইনে আছেন');
                $table->text('offline_message')->nullable();
                
                // Cache Versioning & Maintenance
                $table->string('cache_version')->default('v1.0.0');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pwa_settings');
    }
};
