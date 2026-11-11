<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_title',
        'site_description',
        'contact_email',
        'contact_phone',
        'contact_address',
        'logo',
        'color_theme',
        'primary_color',
        'accent_color',
        'default_mode',
        'enable_theme_switcher',
        'facebook_url',
        'twitter_url',
        'youtube_url',
        'bkash_number',
        'bkash_type',
        'nagad_number',
        'nagad_type',
        'rocket_number',
        'bank_name',
        'bank_branch',
        'bank_account_name',
        'bank_account_number',
        'bank_routing',
    ];

    protected $casts = [
        'enable_theme_switcher' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Color theme presets.
     */
    public static function getPresets(): array
    {
        return [
            'emerald' => [
                'name' => 'ইসলামিক এমারেল্ড (ডিফল্ট)',
                'primary' => '#0C4B36',
                'accent' => '#FBB040',
                'description' => 'শুব্বানের ঐতিহ্যবাহী রাজকীয় সবুজ ও সোনালী আভা',
            ],
            'teal' => [
                'name' => 'রয়্যাল টিল ও সাইয়ান',
                'primary' => '#0d5c75',
                'accent' => '#38bdf8',
                'description' => 'মার্জিত গাঢ় টিল ও আকাশী নীল কম্বিনেশন',
            ],
            'navy' => [
                'name' => 'মিডনাইট নেভি ব্লু',
                'primary' => '#1e3a8a',
                'accent' => '#60a5fa',
                'description' => 'গম্ভীর ও প্রফেশনাল নেভি ব্লু থিম',
            ],
            'maroon' => [
                'name' => 'মরোক্কান মেরুন / বারগান্ডি',
                'primary' => '#6b1d2f',
                'accent' => '#f59e0b',
                'description' => 'ঐতিহাসিক গভীর মেরুন ও সোনা রঙের আকর্ষণ',
            ],
            'olive' => [
                'name' => 'গোল্ডেন অলিভ ও অ্যাম্বার',
                'primary' => '#3f5624',
                'accent' => '#eab308',
                'description' => 'প্রাকৃতিক জলপাই সবুজ ও উজ্জ্বল অ্যাম্বার থিম',
            ],
            'slate' => [
                'name' => 'মডার্ন ডার্ক স্লেট',
                'primary' => '#1e293b',
                'accent' => '#10b981',
                'description' => 'আধুনিক স্লেট চারকোল ও নিওন এমারেল্ড কম্বিনেশন',
            ],
        ];
    }

    /**
     * Get active theme settings with fallback.
     */
    public static function getThemeSettings(): array
    {
        $setting = self::first();
        $presets = self::getPresets();
        $themeKey = $setting->color_theme ?? 'emerald';
        $preset = $presets[$themeKey] ?? $presets['emerald'];

        return [
            'theme_key' => $themeKey,
            'primary_color' => $setting->primary_color ?? $preset['primary'],
            'accent_color' => $setting->accent_color ?? $preset['accent'],
            'default_mode' => $setting->default_mode ?? 'light',
            'enable_theme_switcher' => $setting->enable_theme_switcher ?? true,
        ];
    }
}
