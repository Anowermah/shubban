<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageAccessControl;

class PageAccessControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            // প্রকাশনা ও লাইব্রেরি
            [
                'page_key' => 'books.read',
                'page_name' => 'অনলাইনে পূর্ণাঙ্গ বই পাঠ (ই-বুক রিডার)',
                'page_category' => 'প্রকাশনা ও লাইব্রেরি',
                'route_name' => 'publications.books.read',
                'route_pattern' => 'publications/books/*/read',
                'access_level' => 'authenticated', // গেস্ট দেখতে পারবে না
                'custom_message' => 'অনলাইনে কিতাব ও প্রকাশনা পড়তে অনুগ্রহ করে লগইন করুন। গেস্টদের জন্য বই পাঠ সংরক্ষিত।',
            ],
            [
                'page_key' => 'magazines.read',
                'page_name' => 'মাসিক ম্যাগাজিন/স্মরণিকা পাঠ',
                'page_category' => 'প্রকাশনা ও লাইব্রেরি',
                'route_name' => 'publications.magazines.read',
                'route_pattern' => 'publications/magazines/*/read',
                'access_level' => 'authenticated',
                'custom_message' => 'ম্যাগাজিন ও স্মরণিকা পড়তে লগইন আবশ্যক।',
            ],
            [
                'page_key' => 'articles.read',
                'page_name' => 'গবেষণামূলক প্রবন্ধ ও আর্টিকেল পাঠ',
                'page_category' => 'প্রকাশনা ও লাইব্রেরি',
                'route_name' => 'publications.articles.read',
                'route_pattern' => 'publications/articles/*/read',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'books.list',
                'page_name' => 'সকল বইয়ের তালিকা ও প্রদর্শনী',
                'page_category' => 'প্রকাশনা ও লাইব্রেরি',
                'route_name' => 'publications.books',
                'route_pattern' => 'publications/books',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'magazines.list',
                'page_name' => 'সকল ম্যাগাজিনের তালিকা',
                'page_category' => 'প্রকাশনা ও লাইব্রেরি',
                'route_name' => 'publications.magazines',
                'route_pattern' => 'publications/magazines',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'articles.list',
                'page_name' => 'প্রবন্ধ ও আর্টিকেল আর্কাইভ তালিকা',
                'page_category' => 'প্রকাশনা ও লাইব্রেরি',
                'route_name' => 'publications.articles',
                'route_pattern' => 'publications/articles',
                'access_level' => 'public',
                'custom_message' => null,
            ],

            // প্রশিক্ষণ ও আত্মশুদ্ধি
            [
                'page_key' => 'training.aref',
                'page_name' => 'প্রশিক্ষণ স্তর ০১: আরেফ',
                'page_category' => 'প্রশিক্ষণ ও আত্মশুদ্ধি',
                'route_name' => 'training.aref',
                'route_pattern' => 'training/aref',
                'access_level' => 'authenticated',
                'custom_message' => 'আরেফ প্রশিক্ষণ পাঠ্যক্রম ও বিস্তারিত তথ্য দেখতে লগইন আবশ্যক।',
            ],
            [
                'page_key' => 'training.saleh',
                'page_name' => 'প্রশিক্ষণ স্তর ০২: সালেহ',
                'page_category' => 'প্রশিক্ষণ ও আত্মশুদ্ধি',
                'route_name' => 'training.saleh',
                'route_pattern' => 'training/saleh',
                'access_level' => 'authenticated',
                'custom_message' => 'সালেহ প্রশিক্ষণ পাঠ্যক্রম ও বিস্তারিত তথ্য দেখতে লগইন আবশ্যক।',
            ],
            [
                'page_key' => 'training.rageb',
                'page_name' => 'প্রশিক্ষণ স্তর ০৩: রাগেব',
                'page_category' => 'প্রশিক্ষণ ও আত্মশুদ্ধি',
                'route_name' => 'training.rageb',
                'route_pattern' => 'training/rageb',
                'access_level' => 'authenticated',
                'custom_message' => 'রাগেব প্রশিক্ষণ পাঠ্যক্রম ও বিস্তারিত তথ্য দেখতে লগইন আবশ্যক।',
            ],
            [
                'page_key' => 'training.salek',
                'page_name' => 'প্রশিক্ষণ স্তর ০৪: সালেক',
                'page_category' => 'প্রশিক্ষণ ও আত্মশুদ্ধি',
                'route_name' => 'training.salek',
                'route_pattern' => 'training/salek',
                'access_level' => 'authenticated',
                'custom_message' => 'সালেক প্রশিক্ষণ পাঠ্যক্রম ও বিস্তারিত তথ্য দেখতে লগইন আবশ্যক।',
            ],
            [
                'page_key' => 'training.courses',
                'page_name' => 'প্রশিক্ষণ কোর্সের ওভারভিউ ও পরিচিতি',
                'page_category' => 'প্রশিক্ষণ ও আত্মশুদ্ধি',
                'route_name' => 'training.courses',
                'route_pattern' => 'training/courses',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'training.register',
                'page_name' => 'প্রশিক্ষণ অনলাইন রেজিস্ট্রেশন ফরম',
                'page_category' => 'প্রশিক্ষণ ও আত্মশুদ্ধি',
                'route_name' => 'training.register',
                'route_pattern' => 'training/register/*',
                'access_level' => 'authenticated',
                'custom_message' => 'প্রশিক্ষণে আবেদন করতে আপনার একাউন্টে লগইন থাকতে হবে।',
            ],
            [
                'page_key' => 'education.syllabus',
                'page_name' => 'শিক্ষা সিলেবাস ও পাঠ্যসূচি',
                'page_category' => 'প্রশিক্ষণ ও আত্মশুদ্ধি',
                'route_name' => 'education.syllabus',
                'route_pattern' => 'education/syllabus',
                'access_level' => 'authenticated',
                'custom_message' => 'সিলেবাস ও পাঠ্যসূচি দেখতে লগইন করুন।',
            ],

            // দায়িত্বশীল পরিষদ
            [
                'page_key' => 'responsible.central',
                'page_name' => 'কেন্দ্রীয় দায়িত্বশীল পরিষদ তালিকা',
                'page_category' => 'দায়িত্বশীল পরিষদ',
                'route_name' => 'responsible.central',
                'route_pattern' => 'responsible/central',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'responsible.district',
                'page_name' => 'জেলা দায়িত্বশীল পরিষদ তালিকা',
                'page_category' => 'দায়িত্বশীল পরিষদ',
                'route_name' => 'responsible.district',
                'route_pattern' => 'responsible/district',
                'access_level' => 'authenticated',
                'custom_message' => 'জেলা দায়িত্বশীলদের তালিকা ও যোগাযোগ দেখতে লগইন করুন।',
            ],
            [
                'page_key' => 'responsible.upazila',
                'page_name' => 'উপজেলা দায়িত্বশীল পরিষদ তালিকা',
                'page_category' => 'দায়িত্বশীল পরিষদ',
                'route_name' => 'responsible.upazila',
                'route_pattern' => 'responsible/upazila',
                'access_level' => 'authenticated',
                'custom_message' => 'উপজেলা দায়িত্বশীলদের তালিকা দেখতে লগইন করুন।',
            ],
            [
                'page_key' => 'responsible.branch',
                'page_name' => 'শাখা দায়িত্বশীল পরিষদ তালিকা',
                'page_category' => 'দায়িত্বশীল পরিষদ',
                'route_name' => 'responsible.branch',
                'route_pattern' => 'responsible/branch',
                'access_level' => 'authenticated',
                'custom_message' => 'শাখা দায়িত্বশীলদের তালিকা দেখতে লগইন করুন।',
            ],

            // গ্যালারি ও ঐতিহাসিক আর্কাইভ
            [
                'page_key' => 'gallery.archives',
                'page_name' => 'ঐতিহাসিক ফটো আর্কাইভ অ্যালবাম',
                'page_category' => 'মিডিয়া ও গ্যালারি',
                'route_name' => 'gallery.archives',
                'route_pattern' => 'gallery/archives',
                'access_level' => 'authenticated',
                'custom_message' => 'ঐতিহাসিক দুর্লভ ফটো আর্কাইভ দেখতে লগইন করুন।',
            ],
            [
                'page_key' => 'gallery.photos',
                'page_name' => 'সাধারণ ফটো গ্যালারি',
                'page_category' => 'মিডিয়া ও গ্যালারি',
                'route_name' => 'gallery.photos',
                'route_pattern' => 'gallery/photos',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'gallery.videos',
                'page_name' => 'ভিডিও গ্যালারি',
                'page_category' => 'মিডিয়া ও গ্যালারি',
                'route_name' => 'gallery.videos',
                'route_pattern' => 'gallery/videos',
                'access_level' => 'public',
                'custom_message' => null,
            ],

            // প্রতিষ্ঠান ও সুবিধাসমূহ
            [
                'page_key' => 'facilities.research-center',
                'page_name' => 'শুব্বান রিসার্চ সেন্টার',
                'page_category' => 'প্রতিষ্ঠান ও শাখা',
                'route_name' => 'facilities.research-center',
                'route_pattern' => 'facilities/research-center',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'facilities.shekor',
                'page_name' => 'শেকড় কিশোর সংগঠন',
                'page_category' => 'প্রতিষ্ঠান ও শাখা',
                'route_name' => 'facilities.shekor',
                'route_pattern' => 'facilities/shekor',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'facilities.as-shifa',
                'page_name' => 'আস-শিফা সমাজকল্যাণ ও চিকিৎসা',
                'page_category' => 'প্রতিষ্ঠান ও শাখা',
                'route_name' => 'facilities.as-shifa',
                'route_pattern' => 'facilities/as-shifa',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'facilities.maktabat',
                'page_name' => 'মাকতাবাতুশ শুব্বান লাইব্রেরি',
                'page_category' => 'প্রতিষ্ঠান ও শাখা',
                'route_name' => 'facilities.maktabatush-shubban',
                'route_pattern' => 'facilities/maktabatush-shubban',
                'access_level' => 'public',
                'custom_message' => null,
            ],

            // কার্যক্রম ও ইভেন্ট
            [
                'page_key' => 'activities.index',
                'page_name' => 'সকল কার্যক্রম ও কর্মসূচি',
                'page_category' => 'কার্যক্রম ও ইভেন্ট',
                'route_name' => 'activities.index',
                'route_pattern' => 'activities',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'events.upcoming',
                'page_name' => 'আসন্ন ইভেন্ট ও সম্মেলন',
                'page_category' => 'কার্যক্রম ও ইভেন্ট',
                'route_name' => 'events.upcoming',
                'route_pattern' => 'events/upcoming',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'notice.index',
                'page_name' => 'নোটিশ বোর্ড',
                'page_category' => 'নোটিশ ও তথ্য',
                'route_name' => 'notice.index',
                'route_pattern' => 'notice*',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'donate.index',
                'page_name' => 'অনলাইন অনুদান',
                'page_category' => 'অনুদান',
                'route_name' => 'donate.index',
                'route_pattern' => 'donate*',
                'access_level' => 'public',
                'custom_message' => null,
            ],
            [
                'page_key' => 'contact.index',
                'page_name' => 'যোগাযোগ ও প্রধান কার্যালয়',
                'page_category' => 'সাধারণ',
                'route_name' => 'contact.index',
                'route_pattern' => 'contact',
                'access_level' => 'public',
                'custom_message' => null,
            ],
        ];

        foreach ($pages as $p) {
            PageAccessControl::updateOrCreate(
                ['page_key' => $p['page_key']],
                $p
            );
        }
    }
}
