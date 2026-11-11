<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'author',
        'cover_image',
        'pdf_file',
        'publication_date',
        'category',
        'status'
    ];

    protected $casts = [
        'publication_date' => 'date'
    ];
}
