<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'section_key',
        'name_bn',
        'title',
        'subtitle',
        'badge_text',
        'item_limit',
        'is_active',
        'order',
        'extra_config',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'item_limit' => 'integer',
        'extra_config' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Default list of homepage sections with initial positions and content.
     */
    public static function defaultSections(): array
    {
        return [
            [
                'section_key' => 'hero_slider',
                'name_bn' => 'হিরো স্লাইডার ও নোটিশ স্ক্রল টিকার',
                'title' => 'প্রধান ব্যানার স্লাইডার',
                'subtitle' => 'একটি ঐতিহ্যবাহী অরাজনৈতিক ছাত্র ও যুব আন্দোলন — যুব সমাজের আত্মশুদ্ধি ও মানবতার সেবায় নিবেদিত।',
                'badge_text' => 'সর্বশেষ নোটিশ',
                'item_limit' => 5,
                'is_active' => true,
                'order' => 1,
                'extra_config' => [
                    'icon' => 'fas fa-images',
                    'color' => 'text-primary',
                    'admin_route' => 'admin.sliders.index',
                    'admin_label' => 'স্লাইডার পরিচালনা',
                ],
            ],
            [
                'section_key' => 'quick_stats',
                'name_bn' => 'এক নজরে সাংগঠনিক পরিসংখ্যান (কাউন্টার কার্ড)',
                'title' => 'এক নজরে শুব্বানের সাংগঠনিক শক্তি',
                'subtitle' => 'দেশব্যাপী আমাদের সাংগঠনিক বিস্তার ও যুব কর্মীবাহিনী',
                'badge_text' => 'পরিসংখ্যান',
                'item_limit' => 4,
                'is_active' => true,
                'order' => 2,
                'extra_config' => [
                    'icon' => 'fas fa-chart-line',
                    'color' => 'text-success',
                    'stat1_num' => '৬৪+',
                    'stat1_label' => 'জেলা ও উপজেলা শাখা',
                    'stat2_num' => '১০,০০০+',
                    'stat2_label' => 'যুব সদস্য ও কর্মী',
                    'stat3_num' => '১৭+',
                    'stat3_label' => 'প্রকাশিত গ্রন্থ ও পত্রিকা',
                    'stat4_num' => '৪ স্তর',
                    'stat4_label' => 'ধারাবাহিক যুব প্রশিক্ষণ',
                ],
            ],
            [
                'section_key' => 'core_mission',
                'name_bn' => 'মূল আদর্শ, লক্ষ্য ও পাঁচ দফা কর্মসূচি',
                'title' => 'আমাদের মূল লক্ষ্য ও পাঁচ দফা কর্মসূচি',
                'subtitle' => 'কুরআন ও সহীহ সুন্নাহর নির্ভেজাল আদর্শে তরুণ প্রজন্মকে দক্ষ, খোদাভীরু ও মানবদরদী হিসেবে গড়ে তোলা।',
                'badge_text' => 'আদর্শ ও লক্ষ্য',
                'item_limit' => 5,
                'is_active' => true,
                'order' => 3,
                'extra_config' => [
                    'icon' => 'fas fa-bullseye',
                    'color' => 'text-warning',
                    'motto' => 'কালেমা "লা- ইলাহা ইল্লাল্লাহু মুহাম্মাদুর রাসূলুল্লাহ"-কে যথাযথ উপলব্ধি করত জীবনের সর্বস্তরে কুরআন ও সুন্নাহর বিধান প্রতিষ্ঠার মাধ্যমে আল্লাহর সন্তুষ্টি অর্জন।',
                ],
            ],
            [
                'section_key' => 'facilities',
                'name_bn' => 'বিশেষ প্রতিষ্ঠান ও মূল বিভাগসমূহ',
                'title' => 'আমাদের মূল বিভাগ ও শাখা',
                'subtitle' => 'রিসার্চ সেন্টার, শেকড়, আস-শিফা ও মাকতাবাতুশ শুব্বান',
                'badge_text' => 'বিশেষ প্রতিষ্ঠানসমূহ',
                'item_limit' => 4,
                'is_active' => true,
                'order' => 4,
                'extra_config' => [
                    'icon' => 'fas fa-sitemap',
                    'color' => 'text-info',
                    'admin_route' => 'admin.departments.index',
                    'admin_label' => 'বিভাগ পরিচালনা',
                ],
            ],
            [
                'section_key' => 'training_tiers',
                'name_bn' => '৪-স্তরীয় যুব প্রশিক্ষণ পাঠ্যক্রম',
                'title' => '৪-স্তরীয় অনন্য প্রশিক্ষণ পাঠ্যক্রম',
                'subtitle' => 'সংগঠনের প্রতিটি কর্মীর ধারাবাহিক আত্মশুদ্ধি, দ্বীনি জ্ঞানার্জন ও নেতৃত্বের দক্ষতা অর্জনের সুনির্দিষ্ট স্তর।',
                'badge_text' => 'তারবিয়াত ও নেতৃত্ব',
                'item_limit' => 4,
                'is_active' => true,
                'order' => 5,
                'extra_config' => [
                    'icon' => 'fas fa-graduation-cap',
                    'color' => 'text-primary',
                    'admin_route' => 'admin.training.aref.index',
                    'admin_label' => 'প্রশিক্ষণ পরিচালনা',
                ],
            ],
            [
                'section_key' => 'activities_news',
                'name_bn' => 'সাম্প্রতিক কার্যক্রম ও সর্বশেষ সংবাদ',
                'title' => 'সাম্প্রতিক কার্যক্রম',
                'subtitle' => 'মাঠপর্যায়ের সাংগঠনিক কর্মসূচি এবং সর্বশেষ সংবাদ বুলেটিন',
                'badge_text' => 'সর্বশেষ কার্যক্রম',
                'item_limit' => 4,
                'is_active' => true,
                'order' => 6,
                'extra_config' => [
                    'icon' => 'fas fa-calendar-check',
                    'color' => 'text-success',
                    'news_limit' => 2,
                    'admin_route' => 'admin.activities.index',
                    'admin_label' => 'কার্যক্রম পরিচালনা',
                ],
            ],
            [
                'section_key' => 'notice_board',
                'name_bn' => 'ডিজিটাল নোটিশ বোর্ড ও পোর্টাল লিঙ্ক',
                'title' => 'ডিজিটাল নোটিশ বোর্ড',
                'subtitle' => 'জরুরি সাংগঠনিক ঘোষণা ও বিজ্ঞপ্তি',
                'badge_text' => 'জরুরি বিজ্ঞপ্তি',
                'item_limit' => 5,
                'is_active' => true,
                'order' => 7,
                'extra_config' => [
                    'icon' => 'fas fa-bell',
                    'color' => 'text-warning',
                    'admin_route' => 'admin.notices.index',
                    'admin_label' => 'নোটিশ পরিচালনা',
                ],
            ],
            [
                'section_key' => 'articles',
                'name_bn' => 'গবেষণামূলক প্রবন্ধ ও আর্টিকেল আর্কাইভ',
                'title' => 'প্রবন্ধ ও আর্টিকেল আর্কাইভ',
                'subtitle' => 'ইসলামি ব্যক্তিত্ব, ইতিহাস, আক্বীদা ও সমকালীন বিষয়ের ওপর শুব্বানের গবেষণাধর্মী প্রবন্ধাবলী',
                'badge_text' => 'তাত্ত্বিক ও গবেষণামূলক',
                'item_limit' => 3,
                'is_active' => true,
                'order' => 8,
                'extra_config' => [
                    'icon' => 'fas fa-feather-alt',
                    'color' => 'text-success',
                    'admin_route' => 'admin.publications.articles.index',
                    'admin_label' => 'প্রবন্ধ পরিচালনা',
                ],
            ],
            [
                'section_key' => 'books',
                'name_bn' => 'শুব্বান প্রকাশনা ও বই সম্ভার',
                'title' => 'শুব্বান প্রকাশনা ও মাকতাবাহ',
                'subtitle' => 'প্রকাশিত কিতাবাদি ও তথ্যবহুল সাময়িকী সম্ভার',
                'badge_text' => 'প্রকাশনা ও কিতাব',
                'item_limit' => 4,
                'is_active' => true,
                'order' => 9,
                'extra_config' => [
                    'icon' => 'fas fa-book',
                    'color' => 'text-info',
                    'admin_route' => 'admin.publications.books.index',
                    'admin_label' => 'বই পরিচালনা',
                ],
            ],
            [
                'section_key' => 'photos',
                'name_bn' => 'দৃষ্টিজুড়ানো ফটো গ্যালারি',
                'title' => 'দৃষ্টিজুড়ানো ফটো গ্যালারি',
                'subtitle' => 'জাতীয় সম্মেলন, জেলা সমাবেশ ও বিভিন্ন সমাজকল্যাণমূলক আয়োজনের স্থিরচিত্র',
                'badge_text' => 'মুহূর্ত ও আয়োজন',
                'item_limit' => 8,
                'is_active' => true,
                'order' => 10,
                'extra_config' => [
                    'icon' => 'fas fa-camera-retro',
                    'color' => 'text-danger',
                    'admin_route' => 'admin.photos.index',
                    'admin_label' => 'ফটো পরিচালনা',
                ],
            ],
            [
                'section_key' => 'archives',
                'name_bn' => 'ঐতিহাসিক অ্যালবাম ও ফটো আর্কাইভ',
                'title' => 'ঐতিহাসিক ফটো আর্কাইভ',
                'subtitle' => 'বিগত বছরগুলোর সম্মেলন, মিলনমেলা ও বিশেষ স্মরণীয় আয়োজনসমূহের অ্যালবাম',
                'badge_text' => 'অতীতের স্মৃতি ও অ্যালবাম',
                'item_limit' => 4,
                'is_active' => true,
                'order' => 11,
                'extra_config' => [
                    'icon' => 'fas fa-archive',
                    'color' => 'text-warning',
                    'admin_route' => 'admin.gallery-archives.index',
                    'admin_label' => 'আর্কাইভ পরিচালনা',
                ],
            ],
            [
                'section_key' => 'videos',
                'name_bn' => 'ভিডিও লেকচার ও প্রামাণ্যচিত্র (সিনেমা গ্যালারি)',
                'title' => 'ভিডিও লেকচার ও আলোচনা',
                'subtitle' => 'জাতীয় নেতৃবৃন্দের গুরুত্বপূর্ণ নসীহত, সম্মেলন ও দাওয়াহ প্রামাণ্যচিত্র',
                'badge_text' => 'ইউটিউব ও মিডিয়া',
                'item_limit' => 4,
                'is_active' => true,
                'order' => 12,
                'extra_config' => [
                    'icon' => 'fab fa-youtube',
                    'color' => 'text-danger',
                    'admin_route' => 'admin.videos.index',
                    'admin_label' => 'ভিডিও পরিচালনা',
                ],
            ],
            [
                'section_key' => 'donation_banner',
                'name_bn' => 'সাদকায়ে জারিয়া ও অনুদান কল-টু-অ্যাকশন ব্যানার',
                'title' => 'দ্বীনের প্রসার ও মানবতার সেবায় আপনার দান',
                'subtitle' => 'তরুণ প্রজন্মের চরিত্র গঠন, আর্তমানবতার ফ্রি চিকিৎসা এবং কুরআন-সুন্নাহ ভিত্তিক গবেষণা কার্যক্রমে আপনার আর্থিক সহযোগিতা পরকালীন সঞ্চয়।',
                'badge_text' => 'সাদাক্বায়ে জারিয়া',
                'item_limit' => 1,
                'is_active' => true,
                'order' => 13,
                'extra_config' => [
                    'icon' => 'fas fa-hand-holding-heart',
                    'color' => 'text-warning',
                    'admin_route' => 'admin.donations.index',
                    'admin_label' => 'অনুদান পরিচালনা',
                ],
            ],
        ];
    }

    /**
     * Ensure default sections exist in database.
     */
    public static function seedDefaultsIfEmpty(): void
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('home_sections')) {
                return;
            }
            if (self::count() === 0) {
                foreach (self::defaultSections() as $data) {
                    self::create($data);
                }
            }
        } catch (\Throwable $e) {
            // Silently ignore if database or table not ready
        }
    }

    /**
     * Reset all homepage sections back to standard factory settings.
     */
    public static function resetToDefaults(): void
    {
        self::truncate();
        foreach (self::defaultSections() as $data) {
            self::create($data);
        }
    }

    /**
     * Get all sections keyed by section_key, ordered by sequence.
     */
    public static function getOrderedMap(): array
    {
        self::seedDefaultsIfEmpty();
        $sections = self::orderBy('order')->get();
        $map = [];
        foreach ($sections as $sec) {
            $map[$sec->section_key] = $sec;
        }
        return $map;
    }
}
