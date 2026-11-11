<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PhotoSeeder extends Seeder
{
    public function run()
    {
        // Sample categories
        $categories = ['মাহফিল', 'সম্মেলন', 'সেমিনার', 'প্রশিক্ষণ', 'উদ্বোধন'];
        
        // Sample images
        $sampleImages = [
            'sample1.jpg', 'sample2.jpg', 'sample3.jpg', 'sample4.jpg', 'sample5.jpg',
            'sample6.jpg', 'sample7.jpg', 'sample8.jpg', 'sample9.jpg', 'sample10.jpg'
        ];

        // Create uploads directory if it doesn't exist
        $uploadPath = public_path('uploads/photos');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // Copy sample images to uploads directory
        foreach ($sampleImages as $image) {
            $sourcePath = database_path('seeders/sample_images/' . $image);
            $destPath = $uploadPath . '/' . $image;
            
            if (File::exists($sourcePath)) {
                File::copy($sourcePath, $destPath);
            }
        }

        // Create 20 sample photos
        for ($i = 1; $i <= 20; $i++) {
            $randomImage = $sampleImages[array_rand($sampleImages)];
            $randomCategory = $categories[array_rand($categories)];
            $randomDate = now()->subDays(rand(1, 365));

            Photo::create([
                'image_url' => 'uploads/photos/' . $randomImage,
                'title' => [
                    'bn' => $randomCategory . ' ' . $i,
                    'en' => $randomCategory . ' ' . $i,
                    'ar' => $randomCategory . ' ' . $i
                ],
                'description' => [
                    'bn' => 'এটি একটি নমুনা বিবরণ ' . $i,
                    'en' => 'This is a sample description ' . $i,
                    'ar' => 'هذا وصف تجريبي ' . $i
                ],
                'category' => $randomCategory,
                'date' => $randomDate,
                'status' => true
            ]);
        }
    }
}
