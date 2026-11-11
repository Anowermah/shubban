<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'image',
        'is_annual',
        'registration_required',
        'status'
    ];

    public $translatable = [
        'title',
        'description',
        'location'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_annual' => 'boolean',
        'registration_required' => 'boolean',
        'status' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
