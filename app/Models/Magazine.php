<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issue_number',
        'publication_date',
        'description',
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
