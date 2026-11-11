<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAccessControl extends Model
{
    use HasFactory;

    protected $table = 'page_access_controls';

    protected $fillable = [
        'page_key',
        'page_name',
        'page_category',
        'route_name',
        'route_pattern',
        'access_level',
        'allowed_roles',
        'is_active',
        'custom_message',
    ];

    protected $casts = [
        'allowed_roles' => 'array',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'is_active' => true,
        'access_level' => 'public',
    ];

    public const ACCESS_PUBLIC = 'public';
    public const ACCESS_AUTHENTICATED = 'authenticated';
    public const ACCESS_MEMBER = 'member_only';
    public const ACCESS_TRAINING = 'training_only';
    public const ACCESS_OFFICIAL = 'official_only';
    public const ACCESS_CUSTOM = 'custom';

    /**
     * Get all available access levels with Bengali labels.
     */
    public static function getAccessLevels(): array
    {
        return [
            self::ACCESS_PUBLIC => [
                'label' => 'উন্মুক্ত (সকলের জন্য - গেস্ট সহ)',
                'badge' => 'bg-success',
                'description' => 'গেস্ট ও সাধারণ ভিজিটর সহ যে কেউ দেখতে পারবে।',
                'icon' => 'fa-globe',
            ],
            self::ACCESS_AUTHENTICATED => [
                'label' => 'লগইন আবশ্যক (গেস্ট নিষিদ্ধ)',
                'badge' => 'bg-warning text-dark',
                'description' => 'গেস্টরা দেখতে পারবে না। যেকোনো নিবন্ধিত ও লগইনকৃত ব্যবহারকারী দেখতে পারবে।',
                'icon' => 'fa-lock',
            ],
            self::ACCESS_MEMBER => [
                'label' => 'শুধুমাত্র অনুমোদিত সদস্য',
                'badge' => 'bg-primary',
                'description' => 'সাধারণ নিবন্ধিত ইউজার বা গেস্ট নয়, অনুমোদিত সদস্য বা তদূর্ধ্ব রোল প্রয়োজন।',
                'icon' => 'fa-id-badge',
            ],
            self::ACCESS_TRAINING => [
                'label' => 'শুধুমাত্র প্রশিক্ষণার্থী ও সদস্য',
                'badge' => 'bg-info text-dark',
                'description' => 'আরেফ, সালেহ, রাগেব, সালেক কোর্সের প্রশিক্ষণার্থী ও সদস্যবৃন্দ।',
                'icon' => 'fa-graduation-cap',
            ],
            self::ACCESS_OFFICIAL => [
                'label' => 'শুধুমাত্র দায়িত্বশীল পরিষদ',
                'badge' => 'bg-danger',
                'description' => 'কেন্দ্রীয় ও শাখা দায়িত্বশীল/কর্মকর্তাবৃন্দ।',
                'icon' => 'fa-user-tie',
            ],
            self::ACCESS_CUSTOM => [
                'label' => 'কাস্টম নির্বাচিত রোলসমূহ',
                'badge' => 'bg-secondary',
                'description' => 'নির্বাচিত নির্দিষ্ট রোলসমূহের ব্যবহারকারীগণ প্রবেশ করতে পারবে।',
                'icon' => 'fa-users-cog',
            ],
        ];
    }

    /**
     * Get all user roles with Bengali labels.
     */
    public static function getUserRoles(): array
    {
        return [
            'user' => 'সাধারণ নিবন্ধিত ব্যবহারকারী',
            'member' => 'অনুমোদিত সাধারণ সদস্য',
            'student_aref' => 'প্রশিক্ষণার্থী - আরেফ স্তর',
            'student_saleh' => 'প্রশিক্ষণার্থী - সালেহ স্তর',
            'student_rageb' => 'প্রশিক্ষণার্থী - রাগেব স্তর',
            'student_salek' => 'প্রশিক্ষণার্থী - সালেক স্তর',
            'official' => 'দায়িত্বশীল পরিষদ / কর্মকর্তা',
            'admin' => 'প্রশাসক (পূর্ণ নিয়ন্ত্রণ)',
        ];
    }

    /**
     * Check if a given user (or guest) can access this page.
     *
     * @param  \App\Models\User|null  $user
     * @return bool
     */
    public function userCanAccess($user): bool
    {
        if (!$this->is_active) {
            return true;
        }

        // Public access allows everyone
        if ($this->access_level === self::ACCESS_PUBLIC) {
            return true;
        }

        // If not public, guest cannot access
        if (!$user) {
            return false;
        }

        // Admin always has full access
        if ($user->role === 'admin') {
            return true;
        }

        // Authenticated level: any logged-in user
        if ($this->access_level === self::ACCESS_AUTHENTICATED) {
            return true;
        }

        // Member only: member, students, official, admin
        if ($this->access_level === self::ACCESS_MEMBER) {
            $allowed = ['member', 'student_aref', 'student_saleh', 'student_rageb', 'student_salek', 'official', 'admin'];
            return in_array($user->role, $allowed);
        }

        // Training only: students, official, admin
        if ($this->access_level === self::ACCESS_TRAINING) {
            $allowed = ['student_aref', 'student_saleh', 'student_rageb', 'student_salek', 'official', 'admin'];
            return in_array($user->role, $allowed);
        }

        // Official only
        if ($this->access_level === self::ACCESS_OFFICIAL) {
            $allowed = ['official', 'admin'];
            return in_array($user->role, $allowed);
        }

        // Custom roles
        if ($this->access_level === self::ACCESS_CUSTOM && is_array($this->allowed_roles)) {
            return in_array($user->role, $this->allowed_roles);
        }

        return false;
    }
}
