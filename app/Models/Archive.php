<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'year',
        'cover_image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'year' => 'integer'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function getPhotosCountAttribute()
    {
        return $this->photos()->where('status', true)->count();
    }
}
