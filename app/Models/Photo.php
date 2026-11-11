<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Photo extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'image_url',
        'title',
        'description',
        'category',
        'date',
        'status'
    ];

    protected $casts = [
        'date' => 'datetime',
        'status' => 'boolean'
    ];

    /**
     * Get the full URL for the photo's image
     *
     * @return string
     */
    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return null;
        }
        return asset('storage/' . $value);
    }

    /**
     * Get the raw image path without the storage URL
     *
     * @return string
     */
    public function getRawImagePathAttribute()
    {
        return $this->attributes['image_url'];
    }

    /**
     * Scope a query to only include active photos
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get all available categories
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCategories()
    {
        return static::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->get()
            ->pluck('category')
            ->sort();
    }
}
