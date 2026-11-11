<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'education',
        'experience',
        'expertise',
        'responsibilities',
        'email',
        'phone',
        'office',
        'image',
        'is_active',
        'order'
    ];

    protected $casts = [
        'expertise' => 'array',
        'responsibilities' => 'array',
        'is_active' => 'boolean'
    ];
}
