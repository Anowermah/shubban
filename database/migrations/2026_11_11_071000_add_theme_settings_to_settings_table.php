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
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'color_theme')) {
                $table->string('color_theme')->default('emerald')->after('logo');
            }
            if (!Schema::hasColumn('settings', 'primary_color')) {
                $table->string('primary_color')->default('#0C4B36')->after('color_theme');
            }
            if (!Schema::hasColumn('settings', 'accent_color')) {
                $table->string('accent_color')->default('#FBB040')->after('primary_color');
            }
            if (!Schema::hasColumn('settings', 'default_mode')) {
                $table->string('default_mode')->default('light')->after('accent_color'); // light, dark, auto
            }
            if (!Schema::hasColumn('settings', 'enable_theme_switcher')) {
                $table->boolean('enable_theme_switcher')->default(true)->after('default_mode');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $colsToDrop = array_filter(['color_theme', 'primary_color', 'accent_color', 'default_mode', 'enable_theme_switcher'], function ($col) {
                return Schema::hasColumn('settings', $col);
            });
            if (!empty($colsToDrop)) {
                $table->dropColumn($colsToDrop);
            }
        });
    }
};
