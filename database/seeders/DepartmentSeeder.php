<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            [
                'name' => 'শিক্ষা বিভাগ',
                'head' => 'মাওলানা আব্দুল আলিম',
                'designation' => 'পরিচালক',
                'description' => 'মাদরাসা শিক্ষা ও ইসলামিক শিক্ষার উন্নয়নে কাজ করে',
                'responsibilities' => [
                    'মাদরাসা পাঠ্যক্রম উন্নয়ন',
                    'শিক্ষক প্রশিক্ষণ',
                    'শিক্ষা সংক্রান্ত গবেষণা',
                    'পরীক্ষা পরিচালনা'
                ],
                'email' => 'education@shubban.org',
                'phone' => '+880 1712-334455',
                'location' => '২য় তলা, প্রধান কার্যালয়',
                'staff_count' => 15,
                'order' => 1
            ],
            [
                'name' => 'দাওয়াহ বিভাগ',
                'head' => 'মাওলানা নূরুল হক',
                'designation' => 'পরিচালক',
                'description' => 'ইসলামিক দাওয়াহ ও প্রচার কার্যক্রম পরিচালনা করে',
                'responsibilities' => [
                    'ইসলামিক সেমিনার আয়োজন',
                    'প্রচার সামগ্রী প্রস্তুত',
                    'দাঈ প্রশিক্ষণ',
                    'সামাজিক কার্যক্রম'
                ],
                'email' => 'dawah@shubban.org',
                'phone' => '+880 1713-445566',
                'location' => '৩য় তলা, প্রধান কার্যালয়',
                'staff_count' => 12,
                'order' => 2
            ],
            [
                'name' => 'প্রকাশনা বিভাগ',
                'head' => 'মাওলানা আব্দুল কাদের',
                'designation' => 'পরিচালক',
                'description' => 'ইসলামিক বই, পত্রিকা ও প্রকাশনা কার্যক্রম পরিচালনা করে',
                'responsibilities' => [
                    'বই প্রকাশনা',
                    'মাসিক পত্রিকা প্রকাশ',
                    'অনুবাদ কার্যক্রম',
                    'ডিজিটাল কনটেন্ট তৈরি'
                ],
                'email' => 'publication@shubban.org',
                'phone' => '+880 1714-556677',
                'location' => '৪র্থ তলা, প্রধান কার্যালয়',
                'staff_count' => 10,
                'order' => 3
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
