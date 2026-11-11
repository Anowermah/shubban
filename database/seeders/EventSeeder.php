<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [
                'title' => [
                    'bn' => 'বার্ষিক সম্মেলন ২০২৫',
                    'en' => 'Annual Conference 2025',
                    'ar' => 'المؤتمر السنوي ٢٠٢٥'
                ],
                'description' => [
                    'bn' => 'আমাদের বার্ষিক সম্মেলনে আপনাকে স্বাগতম। এই সম্মেলনে আমরা ইসলামিক জ্ঞান ও শিক্ষার বিভিন্ন দিক নিয়ে আলোচনা করব।',
                    'en' => 'Welcome to our annual conference. We will discuss various aspects of Islamic knowledge and education.',
                    'ar' => 'مرحبا بكم في مؤتمرنا السنوي. سنناقش جوانب مختلفة من المعرفة والتعليم الإسلامي.'
                ],
                'location' => [
                    'bn' => 'ঢাকা, বাংলাদেশ',
                    'en' => 'Dhaka, Bangladesh',
                    'ar' => 'دكا، بنغلاديش'
                ],
                'start_date' => '2025-03-15',
                'end_date' => '2025-03-17',
                'start_time' => '09:00',
                'end_time' => '17:00',
                'is_annual' => true,
                'registration_required' => true,
                'status' => true
            ],
            [
                'title' => [
                    'bn' => 'রমজান মাহফিল',
                    'en' => 'Ramadan Gathering',
                    'ar' => 'مجلس رمضان'
                ],
                'description' => [
                    'bn' => 'পবিত্র রমজান মাসে আয়োজিত এই মাহফিলে কুরআন ও হাদীস নিয়ে আলোচনা করা হবে।',
                    'en' => 'A gathering during the holy month of Ramadan to discuss Quran and Hadith.',
                    'ar' => 'مجلس خلال شهر رمضان المبارك لمناقشة القرآن والحديث.'
                ],
                'location' => [
                    'bn' => 'বায়তুল মোকাররম মসজিদ',
                    'en' => 'Baitul Mukarram Mosque',
                    'ar' => 'مسجد بيت المكرم'
                ],
                'start_date' => '2025-04-01',
                'end_date' => '2025-04-01',
                'start_time' => '20:00',
                'end_time' => '22:00',
                'is_annual' => false,
                'registration_required' => false,
                'status' => true
            ],
            [
                'title' => [
                    'bn' => 'ঈদ মিলন অনুষ্ঠান',
                    'en' => 'Eid Reunion',
                    'ar' => 'لقاء العيد'
                ],
                'description' => [
                    'bn' => 'ঈদের আনন্দ ভাগাভাগি করে নেওয়ার জন্য আয়োজিত এই অনুষ্ঠানে সকলকে স্বাগতম।',
                    'en' => 'Welcome to our Eid reunion celebration where we share the joy of Eid.',
                    'ar' => 'مرحبا بكم في لقاء العيد حيث نتشارك فرحة العيد.'
                ],
                'location' => [
                    'bn' => 'শুব্বান কমপ্লেক্স',
                    'en' => 'Shubban Complex',
                    'ar' => 'مجمع الشبان'
                ],
                'start_date' => '2025-04-15',
                'end_date' => '2025-04-15',
                'start_time' => '15:00',
                'end_time' => '20:00',
                'is_annual' => false,
                'registration_required' => false,
                'status' => true
            ]
        ];

        foreach ($events as $eventData) {
            $slug = Str::slug($eventData['title']['en']);
            Event::create(array_merge($eventData, ['slug' => $slug]));
        }
    }
}
