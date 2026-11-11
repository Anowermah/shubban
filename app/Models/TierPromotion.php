<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TierPromotion extends Model
{
    use HasFactory;

    protected $table = 'tier_promotions';

    protected $fillable = [
        'user_id',
        'current_tier',
        'target_tier',
        'syllabus_completed',
        'books_read',
        'applicant_notes',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'syllabus_completed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getTierLabel(string $tier): string
    {
        $tiers = [
            'general' => 'সাধারণ সদস্য / শুভাকাঙ্ক্ষী',
            'rageb' => 'রাগেব (প্রাথমিক স্তর)',
            'aref' => 'আরেফ (২য় স্তর)',
            'salek' => 'সালেক (৩য় স্তর)',
            'saleh' => 'সালেহ (৪র্থ / দায়িত্বশীল স্তর)',
        ];

        return $tiers[$tier] ?? ucfirst($tier);
    }

    public function getCurrentTierLabelAttribute(): string
    {
        return self::getTierLabel($this->current_tier);
    }

    public function getTargetTierLabelAttribute(): string
    {
        return self::getTierLabel($this->target_tier);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'approved' => '<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> পদোন্নতি অনুমোদিত</span>',
            'rejected' => '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> পুনঃমূল্যায়নের নির্দেশ</span>',
            default => '<span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-1"></i> পর্যালোচনায়</span>',
        };
    }
}
