<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

    protected $table = 'managements';

    protected $fillable = [
        'name',
        'designation',
        'level',
        'area',
        'phone',
        'email',
        'address',
        'image',
        'status',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];

    const LEVEL_CENTRAL = 'central';
    const LEVEL_DISTRICT = 'district';
    const LEVEL_UPAZILA = 'upazila';
    const LEVEL_UNION = 'union';
    const LEVEL_THANA = 'thana';
    const LEVEL_BRANCH = 'branch';

    public function scopeCentral($query)
    {
        return $query->where('level', self::LEVEL_CENTRAL);
    }

    public function scopeDistrict($query)
    {
        return $query->where('level', self::LEVEL_DISTRICT);
    }

    public function scopeUpazila($query)
    {
        return $query->where('level', self::LEVEL_UPAZILA);
    }

    public function scopeThana($query)
    {
        return $query->where('level', self::LEVEL_THANA);
    }

    public function scopeBranch($query)
    {
        return $query->where('level', self::LEVEL_BRANCH);
    }
}
