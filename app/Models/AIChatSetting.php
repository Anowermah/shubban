<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIChatSetting extends Model
{
    protected $table = 'ai_chat_settings';

    protected $fillable = [
        'is_enabled',
        'bot_name',
        'bot_subtitle',
        'welcome_message',
        'fallback_message',
        'system_prompt',
        'ai_provider',
        'api_key',
        'model_name',
        'temperature',
        'enable_floating_widget',
        'widget_position',
        'quick_prompts',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'enable_floating_widget' => 'boolean',
        'temperature' => 'float',
        'quick_prompts' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Default quick prompt suggestions.
     */
    public static function defaultQuickPrompts(): array
    {
        return [
            'শুব্বানের মূল লক্ষ্য ও ৫ দফা কর্মসূচি কি?',
            '৪-স্তরীয় যুব প্রশিক্ষণ সিলেবাস কি কি?',
            'অনুদান দেওয়ার বিকাশ ও ব্যাংক হিসাব',
            'শুব্বান রিসার্চ সেন্টারের সেবা ও ফতোয়া',
            'কীভাবে সদস্য বা কর্মী হওয়া যাবে?',
        ];
    }

    /**
     * Default factory settings.
     */
    public static function defaultSettings(): array
    {
        return [
            'is_enabled' => true,
            'bot_name' => 'শুব্বান এআই সহকারী',
            'bot_subtitle' => '২৪/৭ অনলাইন তথ্য ও দিকনির্দেশনা',
            'welcome_message' => "আসসালামু আলাইকুম ওয়া রাহমাতুল্লাহ! আমি জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ-এর ডিজিটাল এআই সহকারী।\nসংগঠনের লক্ষ্য, কর্মসূচি, প্রশিক্ষণ পাঠ্যক্রম, প্রকাশনা, মানবিক সেবা বা অনুদান সম্পর্কে যেকোনো প্রশ্ন করতে পারেন। আমি কীভাবে সাহায্য করতে পারি?",
            'fallback_message' => "জাযাকাল্লাহু খাইরান। আপনার প্রশ্নটির সুনির্দিষ্ট উত্তর এই মুহূর্তে পাওয়া যায়নি।\nঅনুগ্রহ করে কেন্দ্রীয় কার্যালয়ে যোগাযোগ করুন অথবা ওয়েবসাইট থেকে প্রয়োজনীয় সেকশনটি দেখুন। ইনশাআল্লাহ আমাদের প্রতিনিধি দ্রুত সহায়তা করবেন।",
            'system_prompt' => "You are 'Shubban AI Assistant' (শুব্বান এআই সহকারী), a polite, knowledgeable and authentic Islamic organization assistant representing 'জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ' (Shubban). Always respond in clear, fluent and respectful Bengali. When appropriate, start with an Islamic greeting ('আসসালামু আলাইকুম ওয়া রাহমাতুল্লাহ'). Provide accurate information based on Quran, authentic Sunnah (সহীহ সুন্নাহ), and organizational details. Guide visitors to related pages such as Publications, Training tiers, Donations, and Contact.",
            'ai_provider' => 'internal', // 'internal' = smart built-in rule & knowledge base engine (free, no API key needed), 'gemini', 'openai'
            'api_key' => null,
            'model_name' => 'gemini-1.5-flash',
            'temperature' => 0.7,
            'enable_floating_widget' => true,
            'widget_position' => 'bottom-right',
            'quick_prompts' => self::defaultQuickPrompts(),
        ];
    }

    /**
     * Get active settings with singleton fallback.
     */
    public static function getSettings(): self
    {
        $setting = self::first();
        if (!$setting) {
            $setting = self::create(self::defaultSettings());
        }
        return $setting;
    }
}
