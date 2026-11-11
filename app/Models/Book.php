<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'publication_date',
        'isbn',
        'price',
        'cover_image',
        'pdf_file',
        'status'
    ];

    protected $casts = [
        'publication_date' => 'date',
        'price' => 'decimal:2'
    ];
}
