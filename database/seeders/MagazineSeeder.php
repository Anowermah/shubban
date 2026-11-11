<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Magazine;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MagazineSeeder extends Seeder
{
    public function run()
    {
        // Create test PDF file
        $pdfContent = "Test PDF Content";
        Storage::disk('public')->put('magazines/pdfs/test.pdf', $pdfContent);

        // Create test magazine
        Magazine::create([
            'title' => 'টেস্ট ম্যাগাজিন',
            'issue_number' => '001',
            'publication_date' => Carbon::now(),
            'description' => 'এটি একটি টেস্ট ম্যাগাজিন',
            'pdf_file' => 'magazines/pdfs/test.pdf',
            'status' => 'published'
        ]);
    }
}
