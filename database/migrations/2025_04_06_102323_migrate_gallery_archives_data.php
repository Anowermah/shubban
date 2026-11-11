<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all gallery archives
        $galleryArchives = DB::table('gallery_archives')->get();

        foreach ($galleryArchives as $oldArchive) {
            // Insert into new archives table
            $archiveId = DB::table('archives')->insertGetId([
                'title' => $oldArchive->title,
                'description' => $oldArchive->description,
                'year' => date('Y', strtotime($oldArchive->event_date)),
                'cover_image' => $oldArchive->cover_image ?? '',
                'status' => $oldArchive->status ?? true,
                'created_at' => $oldArchive->created_at,
                'updated_at' => $oldArchive->updated_at
            ]);

            // Update photos that belong to this archive
            DB::table('photos')
                ->where('gallery_archive_id', $oldArchive->id)
                ->update(['archive_id' => $archiveId]);
        }

        // Remove gallery_archive_id from photos table
        if (Schema::hasColumn('photos', 'gallery_archive_id')) {
            Schema::table('photos', function (Blueprint $table) {
                $table->dropForeign(['gallery_archive_id']);
                $table->dropColumn('gallery_archive_id');
            });
        }

        // Drop old gallery_archives table
        Schema::dropIfExists('gallery_archives');

        // Insert some sample archives
        DB::table('archives')->insert([
            [
                'title' => 'ঈদ মিলন মাহফিল ২০২৪',
                'description' => 'ঈদ মিলন মাহফিল ২০২৪ এর স্মৃতিচারণ',
                'year' => 2024,
                'cover_image' => 'archives/eid-2024.jpg',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'বার্ষিক সম্মেলন ২০২৩',
                'description' => 'বার্ষিক সম্মেলন ২০২৩ এর স্মৃতিচারণ',
                'year' => 2023,
                'cover_image' => 'archives/conference-2023.jpg',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ইফতার মাহফিল ২০২৩',
                'description' => 'ইফতার মাহফিল ২০২৩ এর স্মৃতিচারণ',
                'year' => 2023,
                'cover_image' => 'archives/iftar-2023.jpg',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('archives')->truncate();
    }
};
