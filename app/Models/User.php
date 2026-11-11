<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'category',
        'status',
        'worker_tier',
        'org_tier',
        'designation',
        'branch_name',
        'phone',
        'blood_group',
        'profession',
        'address',
        'monthly_iyanat',
        'tier_promoted_at',
        'fcm_token',
    ];

    /**
     * Relationships
     */
    public function iyanats()
    {
        return $this->hasMany(Iyanat::class)->latest();
    }

    public function programReports()
    {
        return $this->hasMany(ProgramReport::class)->latest();
    }

    public function tierPromotions()
    {
        return $this->hasMany(TierPromotion::class)->latest();
    }

    public function syllabusProgress()
    {
        return $this->hasMany(UserSyllabusProgress::class);
    }

    /**
     * Get Bengali Worker Tier Label (রাগেব, আরেফ, সালেক, সালেহ).
     */
    public function getWorkerTierLabelAttribute(): string
    {
        $tiers = [
            'general' => 'সাধারণ সদস্য / শুভাকাঙ্ক্ষী',
            'rageb' => 'রাগেব (১ম স্তর)',
            'aref' => 'আরেফ (২য় স্তর)',
            'salek' => 'সালেক (৩য় স্তর)',
            'saleh' => 'সালেহ (৪র্থ / শীর্ষ স্তর)',
        ];

        return $tiers[$this->worker_tier ?? 'general'] ?? 'সাধারণ সদস্য';
    }

    /**
     * Get Organizational Unit Label (শাখা, থানা, জেলা, কেন্দ্র).
     */
    public function getOrgTierLabelAttribute(): string
    {
        $orgs = [
            'branch' => 'শাখা পরিষদ',
            'upazila' => 'উপজেলা / থানা পরিষদ',
            'district' => 'জেলা পরিষদ',
            'central' => 'কেন্দ্রীয় পরিষদ',
        ];

        return $orgs[$this->org_tier ?? 'branch'] ?? 'শাখা পরিষদ';
    }

    /**
     * Get Next Target Tier.
     */
    public function getNextTierAttribute(): ?string
    {
        return match ($this->worker_tier) {
            'general' => 'rageb',
            'rageb' => 'aref',
            'aref' => 'salek',
            'salek' => 'saleh',
            default => null, // Saleh is highest
        };
    }

    /**
     * Get Next Target Tier Label.
     */
    public function getNextTierLabelAttribute(): ?string
    {
        $next = $this->next_tier;
        if (!$next) return 'সর্বোচ্চ স্তর (সালেহ)';

        return TierPromotion::getTierLabel($next);
    }

    /**
     * Check if current month iyanat has been approved.
     */
    public function getIsCurrentMonthIyanatPaidAttribute(): bool
    {
        $currentMonth = date('F Y');
        return $this->iyanats()
            ->where('status', 'approved')
            ->where('created_at', '>=', now()->startOfMonth())
            ->exists();
    }

    /**
     * Get Bengali role label.
     */
    public function getRoleLabelAttribute(): string
    {
        $roles = [
            'user' => 'সাধারণ ব্যবহারকারী',
            'member' => 'অনুমোদিত সদস্য',
            'student_aref' => 'প্রশিক্ষণার্থী (আরেফ)',
            'student_saleh' => 'প্রশিক্ষণার্থী (সালেহ)',
            'student_rageb' => 'প্রশিক্ষণার্থী (রাগেব)',
            'student_salek' => 'প্রশিক্ষণার্থী (সালেক)',
            'official' => 'দায়িত্বশীল পরিষদ',
            'admin' => 'প্রশাসক',
        ];

        return $roles[$this->role] ?? 'সাধারণ ব্যবহারকারী';
    }

    /**
     * Check if user is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
