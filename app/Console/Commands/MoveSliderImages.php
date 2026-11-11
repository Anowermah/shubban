<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Slider;

class MoveSliderImages extends Command
{
    protected $signature = 'sliders:move-images';
    protected $description = 'Move slider images from storage to public folder';

    public function handle()
    {
        $sliders = Slider::all();
        
        foreach ($sliders as $slider) {
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                $oldPath = storage_path('app/public/' . $slider->image);
                $newPath = public_path('images/sliders/' . basename($slider->image));
                
                if (File::exists($oldPath)) {
                    File::copy($oldPath, $newPath);
                    $slider->update([
                        'image' => 'images/sliders/' . basename($slider->image)
                    ]);
                    $this->info("Moved image: " . $slider->image);
                }
            }
        }

        $this->info('All slider images have been moved to public folder.');
    }
}
