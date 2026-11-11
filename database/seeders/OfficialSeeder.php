<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    public function run()
    {
        $officials = [
            [
                'name' => 'মাওলানা আব্দুল হাকিম',
                'designation' => 'মহাসচিব',
                'education' => 'দাওরায়ে হাদীস, জামিয়া ইসলামিয়া',
                'experience' => '২০ বছর',
                'expertise' => [
                    'ইসলামিক শিক্ষা',
                    'প্রশাসন',
                    'সংগঠন ব্যবস্থাপনা'
                ],
                'responsibilities' => [
                    'কেন্দ্রীয় কার্যালয় পরিচালনা',
                    'নীতি নির্ধারণ',
                    'বিভাগীয় সমন্বয়',
                    'প্রতিষ্ঠানিক উন্নয়ন'
                ],
                'email' => 'secretary@shubban.org',
                'phone' => '+880 1711-223344',
                'office' => '১০১, প্রধান কার্যালয়',
                'image' => 'officials/secretary.jpg',
                'is_active' => true,
                'order' => 1
            ],
            [
                'name' => 'মাওলানা নূরুল ইসলাম',
                'designation' => 'অতিরিক্ত মহাসচিব',
                'education' => 'দাওরায়ে হাদীস, দারুল উলূম',
                'experience' => '১৫ বছর',
                'expertise' => [
                    'শিক্ষা ব্যবস্থাপনা',
                    'প্রশাসন',
                    'মানব সম্পদ উন্নয়ন'
                ],
                'responsibilities' => [
                    'প্রশাসনিক কার্যক্রম',
                    'কর্মী ব্যবস্থাপনা',
                    'প্রকল্প বাস্তবায়ন',
                    'রিপোর্ট প্রস্তুত'
                ],
                'email' => 'addl.secretary@shubban.org',
                'phone' => '+880 1712-334455',
                'office' => '১০২, প্রধান কার্যালয়',
                'image' => 'officials/addl-secretary.jpg',
                'is_active' => true,
                'order' => 2
            ],
            [
                'name' => 'মাওলানা আব্দুল্লাহ',
                'designation' => 'প্রশাসনিক সচিব',
                'education' => 'দাওরায়ে হাদীস, আল-জামিয়া আল-ইসলামিয়া',
                'experience' => '১২ বছর',
                'expertise' => [
                    'প্রশাসন',
                    'অফিস ব্যবস্থাপনা',
                    'ডকুমেন্টেশন'
                ],
                'responsibilities' => [
                    'দৈনন্দিন প্রশাসন',
                    'নথি ব্যবস্থাপনা',
                    'সভা আয়োজন',
                    'সমন্বয় সাধন'
                ],
                'email' => 'admin@shubban.org',
                'phone' => '+880 1713-445566',
                'office' => '১০৩, প্রধান কার্যালয়',
                'image' => 'officials/admin-secretary.jpg',
                'is_active' => true,
                'order' => 3
            ],
            [
                'name' => 'মাওলানা রফিকুল ইসলাম',
                'designation' => 'অর্থ সচিব',
                'education' => 'দাওরায়ে হাদীস, মাদরাসা-ই-আলিয়া',
                'experience' => '১০ বছর',
                'expertise' => [
                    'আর্থিক ব্যবস্থাপনা',
                    'বাজেট',
                    'হিসাবরক্ষণ'
                ],
                'responsibilities' => [
                    'আর্থিক পরিকল্পনা',
                    'বাজেট প্রণয়ন',
                    'অর্থ বরাদ্দ',
                    'অডিট ব্যবস্থাপনা'
                ],
                'email' => 'finance@shubban.org',
                'phone' => '+880 1714-556677',
                'office' => '১০৪, প্রধান কার্যালয়',
                'image' => 'officials/finance-secretary.jpg',
                'is_active' => true,
                'order' => 4
            ],
            [
                'name' => 'মাওলানা সাইফুল ইসলাম',
                'designation' => 'শিক্ষা সচিব',
                'education' => 'দাওরায়ে হাদীস, জামিয়া রাহমানিয়া',
                'experience' => '১৪ বছর',
                'expertise' => [
                    'শিক্ষা ব্যবস্থাপনা',
                    'পাঠ্যক্রম উন্নয়ন',
                    'শিক্ষক প্রশিক্ষণ'
                ],
                'responsibilities' => [
                    'শিক্ষা কার্যক্রম',
                    'পাঠ্যক্রম উন্নয়ন',
                    'পরীক্ষা ব্যবস্থাপনা',
                    'শিক্ষক নিয়োগ'
                ],
                'email' => 'education.secretary@shubban.org',
                'phone' => '+880 1715-667788',
                'office' => '১০৫, প্রধান কার্যালয়',
                'image' => 'officials/education-secretary.jpg',
                'is_active' => true,
                'order' => 5
            ],
            [
                'name' => 'মাওলানা জাহিদুল ইসলাম',
                'designation' => 'প্রচার সচিব',
                'education' => 'দাওরায়ে হাদীস, জামিয়া আশরাফিয়া',
                'experience' => '৮ বছর',
                'expertise' => [
                    'মিডিয়া ব্যবস্থাপনা',
                    'জনসংযোগ',
                    'ডিজিটাল মিডিয়া'
                ],
                'responsibilities' => [
                    'প্রচার কার্যক্রম',
                    'মিডিয়া সম্পর্ক',
                    'সোশ্যাল মিডিয়া',
                    'প্রকাশনা'
                ],
                'email' => 'publicity@shubban.org',
                'phone' => '+880 1716-778899',
                'office' => '১০৬, প্রধান কার্যালয়',
                'image' => 'officials/publicity-secretary.jpg',
                'is_active' => true,
                'order' => 6
            ]
        ];

        foreach ($officials as $official) {
            Official::create($official);
        }
    }
}
