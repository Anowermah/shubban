<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function likes()
    {
        return $this->hasMany(NewsLike::class);
    }

    public function comments()
    {
        return $this->hasMany(NewsComment::class);
    }

    public function getApprovedComments()
    {
        return $this->comments()->where('status', true)->orderBy('created_at', 'desc')->get();
    }
}
