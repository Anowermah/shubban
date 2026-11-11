<?php

namespace Database\Seeders;

use App\Models\Committee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CommitteeSeeder extends Seeder
{
    public function run()
    {
        $members = [
            [
                'name' => 'মাওলানা আব্দুল হাকিম',
                'designation' => 'সভাপতি',
                'phone' => '+880 1711-223344',
                'email' => 'president@shubban.org',
                'address' => 'প্রধান মুফতি, জামিয়া ইসলামিয়া',
                'order' => 1,
                'is_active' => true,
                'image' => 'images/defaults/profile.jpg'
            ],
            [
                'name' => 'মাওলানা নূরুল ইসলাম',
                'designation' => 'সহ-সভাপতি',
                'phone' => '+880 1712-334455',
                'email' => 'vice.president@shubban.org',
                'address' => 'প্রিন্সিপাল, মাদরাসা-ই-আরাবিয়া',
                'order' => 2,
                'is_active' => true,
                'image' => 'images/defaults/profile.jpg'
            ],
            [
                'name' => 'মাওলানা আব্দুর রহমান',
                'designation' => 'মহাসচিব',
                'phone' => '+880 1713-445566',
                'email' => 'secretary@shubban.org',
                'address' => 'অধ্যক্ষ, দারুল উলূম',
                'order' => 3,
                'is_active' => true,
                'image' => 'images/defaults/profile.jpg'
            ],
            [
                'name' => 'মাওলানা মুহাম্মদ আলী',
                'designation' => 'সহ-মহাসচিব',
                'phone' => '+880 1714-556677',
                'email' => 'joint.secretary@shubban.org',
                'address' => 'মুহাদ্দিস, জামিয়া রহমানিয়া',
                'order' => 4,
                'is_active' => true,
                'image' => 'images/defaults/profile.jpg'
            ],
            [
                'name' => 'মাওলানা আব্দুল কাদির',
                'designation' => 'কোষাধ্যক্ষ',
                'phone' => '+880 1715-667788',
                'email' => 'treasurer@shubban.org',
                'address' => 'মুফতি, দারুল ইফতা',
                'order' => 5,
                'is_active' => true,
                'image' => 'images/defaults/profile.jpg'
            ]
        ];

        // Create a simple default profile image using base64 encoded image
        $defaultImagePath = public_path('images/defaults/profile.jpg');
        if (!File::exists(dirname($defaultImagePath))) {
            File::makeDirectory(dirname($defaultImagePath), 0755, true);
        }

        // A simple 1x1 pixel JPEG image in base64
        $base64Image = '/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAABAAEDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAn/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAX/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwCdABmX/9k=';
        
        // Decode and save the base64 image
        $imageData = base64_decode($base64Image);
        File::put($defaultImagePath, $imageData);

        foreach ($members as $member) {
            Committee::create($member);
        }
    }
}
