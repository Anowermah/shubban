<?php

namespace Database\Seeders;

use App\Models\Management;
use Illuminate\Database\Seeder;

class ManagementSeeder extends Seeder
{
    public function run()
    {
        // ১. কেন্দ্রীয় দায়িত্বশীল
        $central = [
            [
                'name' => 'মাওলানা আব্দুল্লাহ',
                'designation' => 'সভাপতি',
                'level' => 'central',
                'phone' => '01712345678',
                'email' => 'president@shubban.org',
                'address' => 'ঢাকা',
                'status' => true,
                'order' => 1
            ],
            [
                'name' => 'মাওলানা রহমান',
                'designation' => 'সেক্রেটারি জেনারেল',
                'level' => 'central',
                'phone' => '01812345678',
                'email' => 'secretary@shubban.org',
                'address' => 'ঢাকা',
                'status' => true,
                'order' => 2
            ],
            [
                'name' => 'মাওলানা করিম',
                'designation' => 'সহ-সভাপতি',
                'level' => 'central',
                'phone' => '01912345678',
                'email' => 'vp@shubban.org',
                'address' => 'ঢাকা',
                'status' => true,
                'order' => 3
            ],
        ];

        foreach ($central as $item) {
            Management::updateOrCreate(
                ['name' => $item['name'], 'level' => 'central'],
                $item
            );
        }

        // ২. জেলা দায়িত্বশীলবৃন্দ (বিভিন্ন জেলাভিত্তিক)
        $districts = [
            // সিরাজগঞ্জ
            [
                'name' => 'মো: রুহুল আমিন',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'সিরাজগঞ্জ',
                'phone' => '০১৭১১-৯৮৭৬৫৪',
                'email' => 'sirajganj@shubban.org',
                'address' => 'সদর, সিরাজগঞ্জ',
                'status' => true,
                'order' => 1
            ],
            [
                'name' => 'মো: আল-আমীন',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'সিরাজগঞ্জ',
                'phone' => '০১৭২২-৩৪৫৬৭৮',
                'email' => 'alameen.sirajganj@shubban.org',
                'address' => 'উল্লাপাড়া, সিরাজগঞ্জ',
                'status' => true,
                'order' => 2
            ],
            [
                'name' => 'হাফেয মো: আব্দুর রহিম',
                'designation' => 'জেলা সাংগঠনিক সম্পাদক',
                'level' => 'district',
                'area' => 'সিরাজগঞ্জ',
                'phone' => '০১৭৩৩-৪৫৬৭৮৯',
                'email' => 'rahim.sirajganj@shubban.org',
                'address' => 'বেলকুচি, সিরাজগঞ্জ',
                'status' => true,
                'order' => 3
            ],

            // ঢাকা জেলা
            [
                'name' => 'মাওলানা সাজ্জাদ হোসেন',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'ঢাকা',
                'phone' => '০১৮১১-১২৩৪৫৬',
                'email' => 'dhaka.president@shubban.org',
                'address' => 'মিরপুর, ঢাকা',
                'status' => true,
                'order' => 4
            ],
            [
                'name' => 'মো: আবু বকর সিদ্দীক',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'ঢাকা',
                'phone' => '০১৮২২-২৩৪৫৬৭',
                'email' => 'dhaka.sec@shubban.org',
                'address' => 'যাত্রাবাড়ী, ঢাকা',
                'status' => true,
                'order' => 5
            ],
            [
                'name' => 'প্রকৌশলী তানভীর আহমেদ',
                'designation' => 'জেলা সাংগঠনিক সম্পাদক',
                'level' => 'district',
                'area' => 'ঢাকা',
                'phone' => '০১৮৩৩-৩৪৫৬৭৮',
                'email' => 'dhaka.org@shubban.org',
                'address' => 'উত্তরা, ঢাকা',
                'status' => true,
                'order' => 6
            ],

            // রাজশাহী
            [
                'name' => 'মাওলানা মুয্যাম্মিল হক',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'রাজশাহী',
                'phone' => '০১৭১২-১১২২৩৩',
                'email' => 'rajshahi.pres@shubban.org',
                'address' => 'বোয়ালিয়া, রাজশাহী',
                'status' => true,
                'order' => 7
            ],
            [
                'name' => 'মো: আব্দুল্লাহ আল-মামুন',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'রাজশাহী',
                'phone' => '০১৭১৩-২২৩৩৪৪',
                'email' => 'rajshahi.sec@shubban.org',
                'address' => 'মতিহার, রাজশাহী',
                'status' => true,
                'order' => 8
            ],
            [
                'name' => 'মো: তারিক জামিল',
                'designation' => 'জেলা সাংগঠনিক সম্পাদক',
                'level' => 'district',
                'area' => 'রাজশাহী',
                'phone' => '০১৭১৪-৩৩৪৪৫৫',
                'email' => 'rajshahi.org@shubban.org',
                'address' => 'পবা, রাজশাহী',
                'status' => true,
                'order' => 9
            ],

            // পাবনা
            [
                'name' => 'মাওলানা মো: ইউসুফ আলী',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'পাবনা',
                'phone' => '০১৭২১-১১২২৩৩',
                'email' => 'pabna.pres@shubban.org',
                'address' => 'পাবনা সদর',
                'status' => true,
                'order' => 10
            ],
            [
                'name' => 'হাফেয মো: ইব্রাহীম খলিল',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'পাবনা',
                'phone' => '০১৭২২-২২৩৩৪৪',
                'email' => 'pabna.sec@shubban.org',
                'address' => 'ঈশ্বরদী, পাবনা',
                'status' => true,
                'order' => 11
            ],
            [
                'name' => 'মো: শফিকুল ইসলাম',
                'designation' => 'জেলা সাংগঠনিক সম্পাদক',
                'level' => 'district',
                'area' => 'পাবনা',
                'phone' => '০১৭২৩-৩৩৪৪৫৫',
                'email' => 'pabna.org@shubban.org',
                'address' => 'চাটমোহর, পাবনা',
                'status' => true,
                'order' => 12
            ],

            // বগুড়া
            [
                'name' => 'মাওলানা মুস্তাফিজুর রহমান',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'বগুড়া',
                'phone' => '০১৭৩১-১১২২৩৩',
                'email' => 'bogura.pres@shubban.org',
                'address' => 'বগুড়া সদর',
                'status' => true,
                'order' => 13
            ],
            [
                'name' => 'মো: মিজানুর রহমান',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'বগুড়া',
                'phone' => '০১৭৩২-২২৩৩৪৪',
                'email' => 'bogura.sec@shubban.org',
                'address' => 'শেরপুর, বগুড়া',
                'status' => true,
                'order' => 14
            ],
            [
                'name' => 'মো: মাহমুদুল হাসান',
                'designation' => 'জেলা সাংগঠনিক সম্পাদক',
                'level' => 'district',
                'area' => 'বগুড়া',
                'phone' => '০১৭৩৩-৩৩৪৪৫৫',
                'email' => 'bogura.org@shubban.org',
                'address' => 'শাজাহানপুর, বগুড়া',
                'status' => true,
                'order' => 15
            ],

            // চাঁপাইনবাবগঞ্জ
            [
                'name' => 'মাওলানা মতিউর রহমান',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'চাঁপাইনবাবগঞ্জ',
                'phone' => '০১৭৪১-১১২২৩৩',
                'email' => 'chapainawabganj@shubban.org',
                'address' => 'চাঁপাইনবাবগঞ্জ সদর',
                'status' => true,
                'order' => 16
            ],
            [
                'name' => 'মো: আনোয়ার হোসেন',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'চাঁপাইনবাবগঞ্জ',
                'phone' => '০১৭৪২-২২৩৩৪৪',
                'email' => 'anowar.chap@shubban.org',
                'address' => 'শিবগঞ্জ, চাঁপাইনবাবগঞ্জ',
                'status' => true,
                'order' => 17
            ],

            // কুষ্টিয়া
            [
                'name' => 'মাওলানা মুসা কালিমুল্লাহ',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'কুষ্টিয়া',
                'phone' => '০১৭৫১-১১২২৩৩',
                'email' => 'kushtia.pres@shubban.org',
                'address' => 'কুষ্টিয়া সদর',
                'status' => true,
                'order' => 18
            ],
            [
                'name' => 'মো: আরিফুল ইসলাম',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'কুষ্টিয়া',
                'phone' => '০১৭৫২-২২৩৩৪৪',
                'email' => 'kushtia.sec@shubban.org',
                'address' => 'কুমারখালী, কুষ্টিয়া',
                'status' => true,
                'order' => 19
            ],

            // চট্টগ্রাম
            [
                'name' => 'মাওলানা উমার ফারুক',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'চট্টগ্রাম',
                'phone' => '০১৮৪১-১১২২৩৩',
                'email' => 'chittagong.pres@shubban.org',
                'address' => 'পাঁচলাইশ, চট্টগ্রাম',
                'status' => true,
                'order' => 20
            ],
            [
                'name' => 'মো: কামরুল হাসান',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'চট্টগ্রাম',
                'phone' => '০১৮৪২-২২৩৩৪৪',
                'email' => 'chittagong.sec@shubban.org',
                'address' => 'হালিশহর, চট্টগ্রাম',
                'status' => true,
                'order' => 21
            ],

            // খুলনা
            [
                'name' => 'মাওলানা আব্দুল কাদের',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'খুলনা',
                'phone' => '০১৯১১-১১২২৩৩',
                'email' => 'khulna.pres@shubban.org',
                'address' => 'খুলনা সদর',
                'status' => true,
                'order' => 22
            ],
            [
                'name' => 'মো: নাজমুল হুদা',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'খুলনা',
                'phone' => '০১৯১২-২২৩৩৪৪',
                'email' => 'khulna.sec@shubban.org',
                'address' => 'খালিশপুর, খুলনা',
                'status' => true,
                'order' => 23
            ],

            // রংপুর
            [
                'name' => 'মাওলানা বোরহান উদ্দীন',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'রংপুর',
                'phone' => '০১৭৭১-১১২২৩৩',
                'email' => 'rangpur.pres@shubban.org',
                'address' => 'রংপুর সদর',
                'status' => true,
                'order' => 24
            ],
            [
                'name' => 'মো: রাশেদুল ইসলাম',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'রংপুর',
                'phone' => '০১৭৭২-২২৩৩৪৪',
                'email' => 'rangpur.sec@shubban.org',
                'address' => 'মিঠাপুকুর, রংপুর',
                'status' => true,
                'order' => 25
            ],

            // যশোর
            [
                'name' => 'মাওলানা শফিউল্লাহ',
                'designation' => 'জেলা সভাপতি',
                'level' => 'district',
                'area' => 'যশোর',
                'phone' => '০১৭৬১-১১২২৩৩',
                'email' => 'jashore.pres@shubban.org',
                'address' => 'যশোর সদর',
                'status' => true,
                'order' => 26
            ],
            [
                'name' => 'মো: ফয়সাল আহমেদ',
                'designation' => 'জেলা সাধারণ সম্পাদক',
                'level' => 'district',
                'area' => 'যশোর',
                'phone' => '০১৭৬২-২২৩৩৪৪',
                'email' => 'jashore.sec@shubban.org',
                'address' => 'মনিরামপুর, যশোর',
                'status' => true,
                'order' => 27
            ],
        ];

        foreach ($districts as $dist) {
            Management::updateOrCreate(
                ['name' => $dist['name'], 'level' => 'district', 'area' => $dist['area']],
                $dist
            );
        }

        // ৩. উপজেলা দায়িত্বশীল
        $upazilas = [
            [
                'name' => 'মাওলানা শাহ আলম',
                'designation' => 'উপজেলা সভাপতি',
                'level' => 'upazila',
                'area' => 'সিরাজগঞ্জ সদর',
                'phone' => '০১৭১৫-০০১১২২',
                'email' => 'sirajganj.sadar@shubban.org',
                'address' => 'সিরাজগঞ্জ সদর',
                'status' => true,
                'order' => 1
            ],
            [
                'name' => 'মো: আব্দুস সামাদ',
                'designation' => 'উপজেলা সভাপতি',
                'level' => 'upazila',
                'area' => 'বেলকুচি',
                'phone' => '০১৭১৫-০০১১৩৩',
                'email' => 'belkuchi@shubban.org',
                'address' => 'বেলকুচি, সিরাজগঞ্জ',
                'status' => true,
                'order' => 2
            ],
            [
                'name' => 'মো: রফিকুল ইসলাম',
                'designation' => 'উপজেলা সভাপতি',
                'level' => 'upazila',
                'area' => 'উল্লাপাড়া',
                'phone' => '০১৭১৫-০০১১৪৪',
                'email' => 'ullahpara@shubban.org',
                'address' => 'উল্লাপাড়া, সিরাজগঞ্জ',
                'status' => true,
                'order' => 3
            ],
            [
                'name' => 'মো: আসাদুজ্জামান',
                'designation' => 'উপজেলা সভাপতি',
                'level' => 'upazila',
                'area' => 'পবা',
                'phone' => '০১৭১৬-০০২২৩৩',
                'email' => 'paba@shubban.org',
                'address' => 'পবা, রাজশাহী',
                'status' => true,
                'order' => 4
            ],
            [
                'name' => 'মাওলানা এনামুল হক',
                'designation' => 'উপজেলা সভাপতি',
                'level' => 'upazila',
                'area' => 'ঈশ্বরদী',
                'phone' => '০১৭১৭-০০৩৩৪৪',
                'email' => 'ishwardi@shubban.org',
                'address' => 'ঈশ্বরদী, পাবনা',
                'status' => true,
                'order' => 5
            ],
        ];

        foreach ($upazilas as $up) {
            Management::updateOrCreate(
                ['name' => $up['name'], 'level' => 'upazila', 'area' => $up['area']],
                $up
            );
        }

        // ৪. থানা দায়িত্বশীল
        $thanas = [
            [
                'name' => 'মো: আসলাম হোসেন',
                'designation' => 'থানা সভাপতি',
                'level' => 'thana',
                'area' => 'মিরপুর থানা',
                'phone' => '০১৮২৫-১১২২৩৩',
                'email' => 'mirpur.thana@shubban.org',
                'address' => 'মিরপুর, ঢাকা',
                'status' => true,
                'order' => 1
            ],
            [
                'name' => 'মো: সাইদুর রহমান',
                'designation' => 'থানা সভাপতি',
                'level' => 'thana',
                'area' => 'ধানমন্ডি থানা',
                'phone' => '০১৮২৫-২২৩৩৪৪',
                'email' => 'dhanmondi.thana@shubban.org',
                'address' => 'ধানমন্ডি, ঢাকা',
                'status' => true,
                'order' => 2
            ],
            [
                'name' => 'মো: শামীম রেজা',
                'designation' => 'থানা সভাপতি',
                'level' => 'thana',
                'area' => 'বোয়ালিয়া থানা',
                'phone' => '০১৮২৫-৩৩৪৪৫৫',
                'email' => 'boalia.thana@shubban.org',
                'address' => 'বোয়ালিয়া, রাজশাহী',
                'status' => true,
                'order' => 3
            ],
        ];

        foreach ($thanas as $th) {
            Management::updateOrCreate(
                ['name' => $th['name'], 'level' => 'thana', 'area' => $th['area']],
                $th
            );
        }

        // ৫. শাখা দায়িত্বশীল
        $branches = [
            [
                'name' => 'মাওলানা সালেহ',
                'designation' => 'শাখা সভাপতি',
                'level' => 'branch',
                'area' => 'মিরপুর শাখা',
                'phone' => '01712345679',
                'email' => 'mirpur@shubban.org',
                'address' => 'মিরপুর-১০, ঢাকা',
                'status' => true,
                'order' => 1
            ],
            [
                'name' => 'মাওলানা হাসান',
                'designation' => 'শাখা সভাপতি',
                'level' => 'branch',
                'area' => 'মোহাম্মদপুর শাখা',
                'phone' => '01812345679',
                'email' => 'mohammadpur@shubban.org',
                'address' => 'মোহাম্মদপুর, ঢাকা',
                'status' => true,
                'order' => 2
            ],
            [
                'name' => 'মাওলানা ইমরান',
                'designation' => 'শাখা সভাপতি',
                'level' => 'branch',
                'area' => 'উত্তরা শাখা',
                'phone' => '01912345679',
                'email' => 'uttara@shubban.org',
                'address' => 'উত্তরা, ঢাকা',
                'status' => true,
                'order' => 3
            ],
        ];

        foreach ($branches as $br) {
            Management::updateOrCreate(
                ['name' => $br['name'], 'level' => 'branch', 'area' => $br['area']],
                $br
            );
        }
    }
}
