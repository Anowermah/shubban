<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'head',
        'designation',
        'description',
        'responsibilities',
        'email',
        'phone',
        'location',
        'staff_count',
        'is_active',
        'order'
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'is_active' => 'boolean',
        'staff_count' => 'integer',
        'order' => 'integer'
    ];
}
