<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'টেস্ট বই',
            'author' => 'টেস্ট লেখক',
            'description' => 'এটি একটি টেস্ট বই',
            'publication_date' => '2024-04-06',
            'isbn' => '1234567890123',
            'price' => 299.99,
            'status' => 'published'
        ]);
    }
}
