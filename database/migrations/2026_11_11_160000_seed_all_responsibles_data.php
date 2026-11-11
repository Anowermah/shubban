<?php

use App\Models\Management;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('managements')) {
            return;
        }

        // Comprehensive Upazila Responsibles (৩২টি উপজেলা)
        $upazilas = [
            ['name' => 'মাওলানা শাহ আলম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'সিরাজগঞ্জ সদর', 'phone' => '০১৭১৫-০০১১২২', 'email' => 'sirajganj.sadar@shubban.org', 'address' => 'সিরাজগঞ্জ সদর, সিরাজগঞ্জ', 'status' => true, 'order' => 1],
            ['name' => 'মো: আব্দুস সামাদ', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'বেলকুচি', 'phone' => '০১৭১৫-০০১১৩৩', 'email' => 'belkuchi@shubban.org', 'address' => 'বেলকুচি, সিরাজগঞ্জ', 'status' => true, 'order' => 2],
            ['name' => 'মো: রফিকুল ইসলাম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'উল্লাপাড়া', 'phone' => '০১৭১৫-০০১১৪৪', 'email' => 'ullahpara@shubban.org', 'address' => 'উল্লাপাড়া, সিরাজগঞ্জ', 'status' => true, 'order' => 3],
            ['name' => 'হাফেজ মো: জহিরুল ইসলাম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'শাহজাদপুর', 'phone' => '০১৭১৫-০০১১৫৫', 'email' => 'shahjadpur@shubban.org', 'address' => 'শাহজাদপুর, সিরাজগঞ্জ', 'status' => true, 'order' => 4],
            ['name' => 'মাওলানা মোজাম্মেল হক', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'কামারখন্দ', 'phone' => '০১৭১৫-০০১১৬৬', 'email' => 'kamarkhanda@shubban.org', 'address' => 'কামারখন্দ, সিরাজগঞ্জ', 'status' => true, 'order' => 5],
            ['name' => 'মো: শফিকুল ইসলাম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'কাজীপুর', 'phone' => '০১৭১৫-০০১১৭৭', 'email' => 'kazipur@shubban.org', 'address' => 'কাজীপুর, সিরাজগঞ্জ', 'status' => true, 'order' => 6],
            ['name' => 'মো: হাবিবুর রহমান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'রায়গঞ্জ', 'phone' => '০১৭১৫-০০১১৮৮', 'email' => 'raiganj@shubban.org', 'address' => 'রায়গঞ্জ, সিরাজগঞ্জ', 'status' => true, 'order' => 7],
            ['name' => 'মাওলানা নূরুল হুদা', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'তাড়াশ', 'phone' => '০১৭১৫-০০১১৯৯', 'email' => 'tarash@shubban.org', 'address' => 'তাড়াশ, সিরাজগঞ্জ', 'status' => true, 'order' => 8],
            ['name' => 'মো: মোস্তফা কামাল', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'চৌহালী', 'phone' => '০১৭১৫-০০১১০১', 'email' => 'chauhali@shubban.org', 'address' => 'চৌহালী, সিরাজগঞ্জ', 'status' => true, 'order' => 9],
            ['name' => 'মো: আসাদুজ্জামান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'পবা', 'phone' => '০১৭১৬-০০২২৩৩', 'email' => 'paba@shubban.org', 'address' => 'পবা, রাজশাহী', 'status' => true, 'order' => 10],
            ['name' => 'মাওলানা সাইদুর রহমান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'গোদাগাড়ী', 'phone' => '০১৭১৬-০০২২৪৪', 'email' => 'godagari@shubban.org', 'address' => 'গোদাগাড়ী, রাজশাহী', 'status' => true, 'order' => 11],
            ['name' => 'মো: জিল্লুর রহমান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'বাগমারা', 'phone' => '০১৭১৬-০০২২৫৫', 'email' => 'bagmara@shubban.org', 'address' => 'বাগমারা, রাজশাহী', 'status' => true, 'order' => 12],
            ['name' => 'মো: মোখলেছুর রহমান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'পুঠিয়া', 'phone' => '০১৭১৬-০০২২৬৬', 'email' => 'puthia@shubban.org', 'address' => 'পুঠিয়া, রাজশাহী', 'status' => true, 'order' => 13],
            ['name' => 'হাফেজ মো: আলতাব হোসেন', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'দুর্গাপুর', 'phone' => '০১৭১৬-০০২২৭৭', 'email' => 'durgapur@shubban.org', 'address' => 'দুর্গাপুর, রাজশাহী', 'status' => true, 'order' => 14],
            ['name' => 'মাওলানা আব্দুল ওহাব', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'বাঘা', 'phone' => '০১৭১৬-০০২২৮৮', 'email' => 'bagha@shubban.org', 'address' => 'বাঘা, রাজশাহী', 'status' => true, 'order' => 15],
            ['name' => 'মো: আনোয়ারুল ইসলাম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'চারঘাট', 'phone' => '০১৭১৬-০০২২৯৯', 'email' => 'charghat@shubban.org', 'address' => 'চারঘাট, রাজশাহী', 'status' => true, 'order' => 16],
            ['name' => 'মো: রেজাউল করিম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'মোহনপুর', 'phone' => '০১৭১৬-০০২২১০', 'email' => 'mohanpur@shubban.org', 'address' => 'মোহনপুর, রাজশাহী', 'status' => true, 'order' => 17],
            ['name' => 'মাওলানা সিরাজুল ইসলাম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'তানোর', 'phone' => '০১৭১৬-০০২২১১', 'email' => 'tanore@shubban.org', 'address' => 'তানোর, রাজশাহী', 'status' => true, 'order' => 18],
            ['name' => 'মাওলানা মাহমুদুল হাসান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'পাবনা সদর', 'phone' => '০১৭১৭-০০৩৩২২', 'email' => 'pabna.sadar@shubban.org', 'address' => 'পাবনা সদর, পাবনা', 'status' => true, 'order' => 19],
            ['name' => 'মাওলানা এনামুল হক', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'ঈশ্বরদী', 'phone' => '০১৭১৭-০০৩৩৪৪', 'email' => 'ishwardi@shubban.org', 'address' => 'ঈশ্বরদী, পাবনা', 'status' => true, 'order' => 20],
            ['name' => 'মো: রশিদুল হাসান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'সাঁথিয়া', 'phone' => '০১৭১৭-০০৩৩৩৩', 'email' => 'santhia@shubban.org', 'address' => 'সাঁথিয়া, পাবনা', 'status' => true, 'order' => 21],
            ['name' => 'মাওলানা দেলোয়ার হোসেন', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'চাটমোহর', 'phone' => '০১৭১৭-০০৩৩৫৫', 'email' => 'chatmohar@shubban.org', 'address' => 'চাটমোহর, পাবনা', 'status' => true, 'order' => 22],
            ['name' => 'মো: জাহাঙ্গীর আলম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'সুজানগর', 'phone' => '০১৭১৭-০০৩৩১৬', 'email' => 'sujanagar@shubban.org', 'address' => 'সুজানগর, পাবনা', 'status' => true, 'order' => 23],
            ['name' => 'মো: শহিদুল ইসলাম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'বেড়া', 'phone' => '০১৭১৭-০০৩৩১৭', 'email' => 'bera@shubban.org', 'address' => 'বেড়া, পাবনা', 'status' => true, 'order' => 24],
            ['name' => 'মাওলানা আব্দুর রাজ্জাক', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'বগুড়া সদর', 'phone' => '০১৭১৮-০০৪৪২২', 'email' => 'bogura.sadar@shubban.org', 'address' => 'বগুড়া সদর, বগুড়া', 'status' => true, 'order' => 25],
            ['name' => 'মো: আব্দুল মান্নান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'শিবগঞ্জ', 'phone' => '০১৭১৮-০০৪৪৩৩', 'email' => 'shibganj.bogura@shubban.org', 'address' => 'শিবগঞ্জ, বগুড়া', 'status' => true, 'order' => 26],
            ['name' => 'হাফেজ মো: আবু বকর', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'শেরপুর', 'phone' => '০১৭১৮-০০৪৪৪৪', 'email' => 'sherpur.bogura@shubban.org', 'address' => 'শেরপুর, বগুড়া', 'status' => true, 'order' => 27],
            ['name' => 'মাওলানা মিজানুর রহমান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'গাবতলী', 'phone' => '০১৭১৮-০০৪৪৫৫', 'email' => 'gabtali@shubban.org', 'address' => 'গাবতলী, বগুড়া', 'status' => true, 'order' => 28],
            ['name' => 'মাওলানা মোস্তাফিজুর রহমান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'চাঁপাইনবাবগঞ্জ সদর', 'phone' => '০১৭১৯-০০৫৫২২', 'email' => 'chapainawabganj.sadar@shubban.org', 'address' => 'চাঁপাইনবাবগঞ্জ সদর', 'status' => true, 'order' => 29],
            ['name' => 'মো: রওশন আলী', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'নওগাঁ সদর', 'phone' => '০১৭১২-০০৬৬২২', 'email' => 'naogaon.sadar@shubban.org', 'address' => 'নওগাঁ সদর', 'status' => true, 'order' => 30],
            ['name' => 'মাওলানা নজরুল ইসলাম', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'নাটোর সদর', 'phone' => '০১৭১৩-০০৭৭২২', 'email' => 'natore.sadar@shubban.org', 'address' => 'নাটোর সদর', 'status' => true, 'order' => 31],
            ['name' => 'মাওলানা কামরুল হাসান', 'designation' => 'উপজেলা সভাপতি', 'level' => 'upazila', 'area' => 'সাভার', 'phone' => '০১৮১১-৫৫৮৮১১', 'email' => 'savar@shubban.org', 'address' => 'সাভার, ঢাকা', 'status' => true, 'order' => 32],
        ];

        foreach ($upazilas as $up) {
            Management::updateOrCreate(
                ['name' => $up['name'], 'level' => 'upazila', 'area' => $up['area']],
                $up
            );
        }

        // Comprehensive Thana Responsibles (১৬টি থানা)
        $thanas = [
            ['name' => 'মো: আসলাম হোসেন', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'মিরপুর থানা', 'phone' => '০১৮২৫-১১২২৩৩', 'email' => 'mirpur.thana@shubban.org', 'address' => 'মিরপুর, ঢাকা', 'status' => true, 'order' => 1],
            ['name' => 'মো: সাইদুর রহমান', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'ধানমন্ডি থানা', 'phone' => '০১৮২৫-২২৩৩৪৪', 'email' => 'dhanmondi.thana@shubban.org', 'address' => 'ধানমন্ডি, ঢাকা', 'status' => true, 'order' => 2],
            ['name' => 'মো: শামীম রেজা', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'বোয়ালিয়া থানা', 'phone' => '০১৮২৫-৩৩৪৪৫৫', 'email' => 'boalia.thana@shubban.org', 'address' => 'বোয়ালিয়া, রাজশাহী', 'status' => true, 'order' => 3],
            ['name' => 'হাফেজ মো: জসিম উদ্দিন', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'মতিহার থানা', 'phone' => '০১৮২৫-৪৪৫৫৬৬', 'email' => 'motihar.thana@shubban.org', 'address' => 'মতিহার, রাজশাহী', 'status' => true, 'order' => 4],
            ['name' => 'মাওলানা রবিউল আউয়াল', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'রাজপাড়া থানা', 'phone' => '০১৮২৫-৫৫৬৬৭৭', 'email' => 'rajpara.thana@shubban.org', 'address' => 'রাজপাড়া, রাজশাহী', 'status' => true, 'order' => 5],
            ['name' => 'মো: মশিউর রহমান', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'শাহ মখদুম থানা', 'phone' => '০১৮২৫-৬৬৭৭৮৮', 'email' => 'shahmakhdum.thana@shubban.org', 'address' => 'শাহ মখদুম, রাজশাহী', 'status' => true, 'order' => 6],
            ['name' => 'মাওলানা তৌহিদুল ইসলাম', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'মোহাম্মদপুর থানা', 'phone' => '০১৮২৫-৭৭৮৮৯৯', 'email' => 'mohammadpur.thana@shubban.org', 'address' => 'মোহাম্মদপুর, ঢাকা', 'status' => true, 'order' => 7],
            ['name' => 'মো: মাহফুজুর রহমান', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'উত্তরা পূর্ব থানা', 'phone' => '০১৮২৫-৮৮৯৯০০', 'email' => 'uttara.east@shubban.org', 'address' => 'উত্তরা, ঢাকা', 'status' => true, 'order' => 8],
            ['name' => 'মো: সালাহউদ্দীন', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'উত্তরা পশ্চিম থানা', 'phone' => '০১৮২৫-৯৯০০১১', 'email' => 'uttara.west@shubban.org', 'address' => 'উত্তরা, ঢাকা', 'status' => true, 'order' => 9],
            ['name' => 'মাওলানা ইমরান হোসাইন', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'যাত্রাবাড়ী থানা', 'phone' => '০১৮২৫-০১১২২৩', 'email' => 'jatrabari.thana@shubban.org', 'address' => 'যাত্রাবাড়ী, ঢাকা', 'status' => true, 'order' => 10],
            ['name' => 'ইঞ্জিনিয়ার মো: ফারহান সাদিক', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'গুলশান থানা', 'phone' => '০১৮২৫-১২৩৪৫৬', 'email' => 'gulshan.thana@shubban.org', 'address' => 'গুলশান, ঢাকা', 'status' => true, 'order' => 11],
            ['name' => 'মো: আশরাফুল আলম', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'বাড্ডা থানা', 'phone' => '০১৮২৫-২৩৪৫৬৭', 'email' => 'badda.thana@shubban.org', 'address' => 'বাড্ডা, ঢাকা', 'status' => true, 'order' => 12],
            ['name' => 'মাওলানা জামাল উদ্দীন', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'কোতোয়ালী থানা', 'phone' => '০১৮২৫-৩৪৫৬৭৮', 'email' => 'kotwali.ctg@shubban.org', 'address' => 'কোতোয়ালী, চট্টগ্রাম', 'status' => true, 'order' => 13],
            ['name' => 'মো: কায়সার আহমেদ', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'পাঁচলাইশ থানা', 'phone' => '০১৮২৫-৪৫৬৭৮৯', 'email' => 'panchlaish.ctg@shubban.org', 'address' => 'পাঁচলাইশ, চট্টগ্রাম', 'status' => true, 'order' => 14],
            ['name' => 'মো: ইব্রাহিম খলিল', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'খালিশপুর থানা', 'phone' => '০১৮২৫-৫৬৭৮৯০', 'email' => 'khalishpur.khulna@shubban.org', 'address' => 'খালিশপুর, খুলনা', 'status' => true, 'order' => 15],
            ['name' => 'মাওলানা আবু ইউসুফ', 'designation' => 'থানা সভাপতি', 'level' => 'thana', 'area' => 'সোনাডাঙ্গা থানা', 'phone' => '০১৮২৫-৬৭৮৯০১', 'email' => 'sonadanga.khulna@shubban.org', 'address' => 'সোনাডাঙ্গা, খুলনা', 'status' => true, 'order' => 16],
        ];

        foreach ($thanas as $th) {
            Management::updateOrCreate(
                ['name' => $th['name'], 'level' => 'thana', 'area' => $th['area']],
                $th
            );
        }

        // Comprehensive Branch Responsibles (১৫টি শাখা)
        $branches = [
            ['name' => 'মাওলানা সালেহ আহমেদ', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'মিরপুর কেন্দ্রীয় শাখা', 'phone' => '০১৭১২-৩৪৫৬৭৯', 'email' => 'mirpur.branch@shubban.org', 'address' => 'মিরপুর-১০, ঢাকা', 'status' => true, 'order' => 1],
            ['name' => 'মাওলানা হাসান মাহমুদ', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'মোহাম্মদপুর শাখা', 'phone' => '০১৮১২-৩৪৫৬৭৯', 'email' => 'mohammadpur.branch@shubban.org', 'address' => 'মোহাম্মদপুর, ঢাকা', 'status' => true, 'order' => 2],
            ['name' => 'মাওলানা ইমরান হুসাইন', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'উত্তরা মডেল শাখা', 'phone' => '০১৯১২-৩৪৫৬৭৯', 'email' => 'uttara.branch@shubban.org', 'address' => 'উত্তরা সেক্টর ৭, ঢাকা', 'status' => true, 'order' => 3],
            ['name' => 'মো: আব্দুল্লাহ আল মামুন', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'রাজশাহী বিশ্ববিদ্যালয় শাখা', 'phone' => '০১৭২২-৯৮৭৬৫৪', 'email' => 'ru.branch@shubban.org', 'address' => 'বিশ্ববিদ্যালয় ক্যাম্পাস, রাজশাহী', 'status' => true, 'order' => 4],
            ['name' => 'মো: মুশফিকুর রহমান', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'ঢাকা বিশ্ববিদ্যালয় শাখা', 'phone' => '০১৮২২-৯৮৭৬৫৪', 'email' => 'du.branch@shubban.org', 'address' => 'কার্জন হল এরিয়া, ঢাকা বিশ্ববিদ্যালয়', 'status' => true, 'order' => 5],
            ['name' => 'হাফেজ মো: আল-আমিন', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'বেলকুচি বাজার শাখা', 'phone' => '০১৭১৩-৪৫৬৭৮৯', 'email' => 'belkuchi.bazar@shubban.org', 'address' => 'মুকন্দগাঁতী বাজার, বেলকুচি, সিরাজগঞ্জ', 'status' => true, 'order' => 6],
            ['name' => 'মো: সাইফুল ইসলাম', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'উল্লাপাড়া পৌর শাখা', 'phone' => '০১৭১৩-৫৬৭৮৯০', 'email' => 'ullahpara.pouro@shubban.org', 'address' => 'পৌরসভা রোড, উল্লাপাড়া, সিরাজগঞ্জ', 'status' => true, 'order' => 7],
            ['name' => 'মো: রাশিদুল ইসলাম', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'সিরাজগঞ্জ সদর পৌর শাখা', 'phone' => '০১৭১৩-৬৭৮৯০১', 'email' => 'sirajganj.pouro@shubban.org', 'address' => 'স্টেশন রোড, সিরাজগঞ্জ সদর', 'status' => true, 'order' => 8],
            ['name' => 'মো: তারেক মাহমুদ', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'ঈশ্বরদী জংশন শাখা', 'phone' => '০১৭১৩-৭৮৯০১২', 'email' => 'ishwardi.junction@shubban.org', 'address' => 'রেলওয়ে জংশন এলাকা, ঈশ্বরদী, পাবনা', 'status' => true, 'order' => 9],
            ['name' => 'মাওলানা আনিসুর রহমান', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'পাবনা পৌর শাখা', 'phone' => '০১৭১৩-৮৯০১২৩', 'email' => 'pabna.pouro@shubban.org', 'address' => 'আব্দুল হামিদ রোড, পাবনা', 'status' => true, 'order' => 10],
            ['name' => 'মো: মোস্তাফিজার রহমান', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'বগুড়া সাতমাথা শাখা', 'phone' => '০১৭১৩-৯০১২৩৪', 'email' => 'bogura.satmatha@shubban.org', 'address' => 'সাতমাথা মোড়, বগুড়া সদর', 'status' => true, 'order' => 11],
            ['name' => 'মাওলানা আব্দুল হাফিজ', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'সিলেট বন্দরবাজার শাখা', 'phone' => '০১৭১৩-০১২৩৪৫', 'email' => 'sylhet.bandar@shubban.org', 'address' => 'বন্দরবাজার, সিলেট সদর', 'status' => true, 'order' => 12],
            ['name' => 'মো: নাজিম উদ্দীন', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'চট্টগ্রাম চকবাজার শাখা', 'phone' => '০১৭১৩-১২৩৪৫৬', 'email' => 'ctg.chawkbazar@shubban.org', 'address' => 'চকবাজার মোড়, চট্টগ্রাম', 'status' => true, 'order' => 13],
            ['name' => 'মো: মুজাহিদুল ইসলাম', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'খুলনা রূপসা শাখা', 'phone' => '০১৭১৩-২৩৪৫৬৭', 'email' => 'khulna.rupsha@shubban.org', 'address' => 'রূপসা ট্রাফিক মোড়, খুলনা', 'status' => true, 'order' => 14],
            ['name' => 'মো: সেলিম রেজা', 'designation' => 'শাখা সভাপতি', 'level' => 'branch', 'area' => 'রংপুর পায়রা চত্বর শাখা', 'phone' => '০১৭১৩-৩৪৫৬৭৮', 'email' => 'rangpur.payra@shubban.org', 'address' => 'পায়রা চত্বর, রংপুর সদর', 'status' => true, 'order' => 15],
        ];

        foreach ($branches as $br) {
            Management::updateOrCreate(
                ['name' => $br['name'], 'level' => 'branch', 'area' => $br['area']],
                $br
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Keep data intact on rollback
    }
};
