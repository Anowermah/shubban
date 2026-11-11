<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    public function run()
    {
        $notices = [
            [
                'title' => [
                    'bn' => 'আগামীকাল থেকে কোরআন শিক্ষা কোর্স শুরু',
                    'en' => 'Quran Education Course Starting Tomorrow',
                    'ar' => 'دورة تعليم القرآن تبدأ غدا'
                ],
                'description' => [
                    'bn' => 'আগামীকাল সকাল ৯টা থেকে কোরআন শিক্ষা কোর্স শুরু হবে',
                    'en' => 'Quran education course will start tomorrow at 9 AM',
                    'ar' => 'ستبدأ دورة تعليم القرآن غدا الساعة 9 صباحا'
                ],
                'category' => 'education',
                'created_at' => now()
            ],
            [
                'title' => [
                    'bn' => 'জুমার নামাজের নতুন সময়সূচী',
                    'en' => 'New Schedule for Jummah Prayer',
                    'ar' => 'جدول جديد لصلاة الجمعة'
                ],
                'description' => [
                    'bn' => 'আগামী শুক্রবার থেকে জুমার নামাজ ১:৩০ টায় শুরু হবে',
                    'en' => 'From next Friday, Jummah prayer will start at 1:30 PM',
                    'ar' => 'من يوم الجمعة القادم ، ستبدأ صلاة الجمعة الساعة 1:30 مساءً'
                ],
                'category' => 'prayer',
                'created_at' => now()
            ],
            [
                'title' => [
                    'bn' => 'ইফতার মাহফিলের আয়োজন',
                    'en' => 'Iftar Gathering Arrangement',
                    'ar' => 'ترتيب تجمع الإفطار'
                ],
                'description' => [
                    'bn' => 'আগামী রমজান মাসে প্রতিদিন ইফতার মাহফিলের আয়োজন করা হবে',
                    'en' => 'Daily Iftar gathering will be arranged in the upcoming Ramadan',
                    'ar' => 'سيتم ترتيب تجمع الإفطار اليومي في رمضان القادم'
                ],
                'category' => 'event',
                'created_at' => now()
            ],
            [
                'title' => [
                    'bn' => 'নতুন লাইব্রেরি উদ্বোধন',
                    'en' => 'New Library Opening',
                    'ar' => 'افتتاح مكتبة جديدة'
                ],
                'description' => [
                    'bn' => 'আগামী রবিবার নতুন ইসলামিক লাইব্রেরি উদ্বোধন করা হবে',
                    'en' => 'New Islamic library will be inaugurated next Sunday',
                    'ar' => 'سيتم افتتاح المكتبة الإسلامية الجديدة يوم الأحد القادم'
                ],
                'category' => 'library',
                'created_at' => now()
            ],
            [
                'title' => [
                    'bn' => 'হাদীস শিক্ষা সেমিনার',
                    'en' => 'Hadith Education Seminar',
                    'ar' => 'ندوة تعليم الحديث'
                ],
                'description' => [
                    'bn' => 'আগামী সপ্তাহে তিন দিনব্যাপী হাদীস শিক্ষা সেমিনার অনুষ্ঠিত হবে',
                    'en' => 'Three-day Hadith education seminar will be held next week',
                    'ar' => 'ستقام ندوة تعليم الحديث لمدة ثلاثة أيام الأسبوع القادم'
                ],
                'category' => 'education',
                'created_at' => now()
            ]
        ];

        foreach ($notices as $notice) {
            Notice::create($notice);
        }
    }
}
