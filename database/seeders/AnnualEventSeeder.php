<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnualEventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [
                'title' => [
                    'bn' => 'ঈদুল ফিতর',
                    'en' => 'Eid ul-Fitr',
                    'ar' => 'عيد الفطر'
                ],
                'description' => [
                    'bn' => 'রমজান মাসের শেষে ঈদুল ফিতর উদযাপন',
                    'en' => 'Celebration of Eid ul-Fitr at the end of Ramadan',
                    'ar' => 'الاحتفال بعيد الفطر في نهاية شهر رمضان'
                ],
                'location' => [
                    'bn' => 'কেন্দ্রীয় ঈদগাহ',
                    'en' => 'Central Eidgah',
                    'ar' => 'المصلى المركزي'
                ],
                'start_date' => '2025-04-20',
                'start_time' => '07:00',
                'is_annual' => true
            ],
            [
                'title' => [
                    'bn' => 'ঈদুল আযহা',
                    'en' => 'Eid ul-Adha',
                    'ar' => 'عيد الأضحى'
                ],
                'description' => [
                    'bn' => 'কুরবানির ঈদ উদযাপন',
                    'en' => 'Celebration of Eid ul-Adha',
                    'ar' => 'الاحتفال بعيد الأضحى'
                ],
                'location' => [
                    'bn' => 'কেন্দ্রীয় ঈদগাহ',
                    'en' => 'Central Eidgah',
                    'ar' => 'المصلى المركزي'
                ],
                'start_date' => '2025-06-27',
                'start_time' => '07:00',
                'is_annual' => true
            ],
            [
                'title' => [
                    'bn' => 'শবে বরাত',
                    'en' => 'Shab-e-Barat',
                    'ar' => 'ليلة البراءة'
                ],
                'description' => [
                    'bn' => 'পবিত্র শবে বরাত উদযাপন',
                    'en' => 'Celebration of the holy night of Shab-e-Barat',
                    'ar' => 'الاحتفال بليلة البراءة المباركة'
                ],
                'location' => [
                    'bn' => 'কেন্দ্রীয় মসজিদ',
                    'en' => 'Central Mosque',
                    'ar' => 'المسجد المركزي'
                ],
                'start_date' => '2025-02-15',
                'start_time' => '18:00',
                'is_annual' => true
            ],
            [
                'title' => [
                    'bn' => 'বার্ষিক মাহফিল',
                    'en' => 'Annual Mahfil',
                    'ar' => 'المحفل السنوي'
                ],
                'description' => [
                    'bn' => 'বার্ষিক ইসলামী মাহফিল',
                    'en' => 'Annual Islamic Gathering',
                    'ar' => 'المحفل الإسلامي السنوي'
                ],
                'location' => [
                    'bn' => 'প্রধান মিলনায়তন',
                    'en' => 'Main Auditorium',
                    'ar' => 'القاعة الرئيسية'
                ],
                'start_date' => '2025-03-15',
                'start_time' => '14:00',
                'end_time' => '22:00',
                'is_annual' => true,
                'registration_required' => true
            ],
            [
                'title' => [
                    'bn' => 'কুরআন প্রতিযোগিতা',
                    'en' => 'Quran Competition',
                    'ar' => 'مسابقة القرآن'
                ],
                'description' => [
                    'bn' => 'বার্ষিক কুরআন তিলাওয়াত ও হিফজ প্রতিযোগিতা',
                    'en' => 'Annual Quran Recitation and Memorization Competition',
                    'ar' => 'المسابقة السنوية لتلاوة وحفظ القرآن'
                ],
                'location' => [
                    'bn' => 'কেন্দ্রীয় মাদরাসা',
                    'en' => 'Central Madrasa',
                    'ar' => 'المدرسة المركزية'
                ],
                'start_date' => '2025-05-01',
                'end_date' => '2025-05-03',
                'start_time' => '09:00',
                'end_time' => '17:00',
                'is_annual' => true,
                'registration_required' => true
            ]
        ];

        foreach ($events as $eventData) {
            $slug = Str::slug($eventData['title']['en']);
            Event::create(array_merge($eventData, ['slug' => $slug]));
        }
    }
}
