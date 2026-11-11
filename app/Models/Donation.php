<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_no',
        'name',
        'is_anonymous',
        'phone',
        'sender_number',
        'email',
        'amount',
        'category',
        'cause_id',
        'payment_method',
        'transaction_id',
        'receipt_image',
        'status',
        'message',
        'admin_notes',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function cause()
    {
        return $this->belongsTo(DonationCause::class, 'cause_id');
    }

    public function getDisplayNameAttribute()
    {
        if ($this->is_anonymous) {
            return 'এক দ্বীনি ভাই/বোন (গোপন দান)';
        }
        return $this->name;
    }

    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'approved':
                return '<span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold"><i class="fas fa-check-circle me-1"></i>অনুমোদিত</span>';
            case 'rejected':
                return '<span class="badge bg-danger-subtle text-danger px-3 py-1 rounded-pill fw-bold"><i class="fas fa-times-circle me-1"></i>বাতিল</span>';
            default:
                return '<span class="badge bg-warning-subtle text-dark px-3 py-1 rounded-pill fw-bold"><i class="fas fa-clock me-1"></i>যাচাইাধীন</span>';
        }
    }
}
