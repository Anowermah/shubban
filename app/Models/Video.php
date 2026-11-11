<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'thumbnail_url',
        'category',
        'date',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'status' => 'boolean'
    ];
}
