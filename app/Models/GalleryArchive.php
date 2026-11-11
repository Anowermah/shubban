<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'event_date',
        'category',
        'status',
        'order'
    ];

    protected $casts = [
        'event_date' => 'date',
        'status' => 'boolean'
    ];
}
