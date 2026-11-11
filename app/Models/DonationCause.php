<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationCause extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'target_amount',
        'raised_amount',
        'icon',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'cause_id');
    }

    public function getProgressPercentageAttribute()
    {
        if (!$this->target_amount || $this->target_amount <= 0) {
            return 0;
        }
        $pct = ($this->raised_amount / $this->target_amount) * 100;
        return min(100, round($pct, 1));
    }
}
