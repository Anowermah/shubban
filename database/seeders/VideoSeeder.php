<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run()
    {
        $videos = [
            [
                'thumbnail_url' => 'images/gallery/videos/thumb-1.jpg',
                'url' => 'https://www.youtube.com/watch?v=VIDEO_ID_1',
                'embed_url' => 'https://www.youtube.com/embed/VIDEO_ID_1',
                'title' => [
                    'bn' => 'ইসলামী বক্তৃতা',
                    'en' => 'Islamic Lecture',
                    'ar' => 'محاضرة إسلامية'
                ],
                'description' => [
                    'bn' => 'ইসলামী আকীদা বিষয়ক বক্তৃতা',
                    'en' => 'Lecture on Islamic Aqeedah',
                    'ar' => 'محاضرة عن العقيدة الإسلامية'
                ],
                'category' => 'lectures',
                'date' => '2024-02-01',
                'duration' => '45:30'
            ],
            [
                'thumbnail_url' => 'images/gallery/videos/thumb-2.jpg',
                'url' => 'https://www.youtube.com/watch?v=VIDEO_ID_2',
                'embed_url' => 'https://www.youtube.com/embed/VIDEO_ID_2',
                'title' => [
                    'bn' => 'সাক্ষাৎকার',
                    'en' => 'Interview',
                    'ar' => 'مقابلة'
                ],
                'description' => [
                    'bn' => 'প্রধান শিক্ষকের সাক্ষাৎকার',
                    'en' => 'Interview with Principal',
                    'ar' => 'مقابلة مع المدير'
                ],
                'category' => 'interviews',
                'date' => '2024-01-20',
                'duration' => '15:45'
            ]
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
