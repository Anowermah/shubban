<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramReport extends Model
{
    use HasFactory;

    protected $table = 'program_reports';

    protected $fillable = [
        'user_id',
        'org_tier',
        'branch_name',
        'program_type',
        'title',
        'date',
        'venue',
        'worker_attendance',
        'guest_attendance',
        'description',
        'attachment',
        'status',
        'admin_feedback',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOrgTierLabelAttribute(): string
    {
        $tiers = [
            'branch' => 'শাখা / ওয়ার্ড',
            'upazila' => 'উপজেলা / থানা',
            'district' => 'জেলা',
            'central' => 'কেন্দ্রীয়',
        ];

        return $tiers[$this->org_tier] ?? $this->org_tier;
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'approved' => '<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> অনুমোদিত</span>',
            'under_review' => '<span class="badge bg-info text-dark"><i class="fas fa-search me-1"></i> মূল্যায়নাধীন</span>',
            default => '<span class="badge bg-warning text-dark"><i class="fas fa-paper-plane me-1"></i> জমাকৃত</span>',
        };
    }
}
