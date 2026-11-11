<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iyanat extends Model
{
    use HasFactory;

    protected $table = 'iyanats';

    protected $fillable = [
        'user_id',
        'receipt_no',
        'month',
        'amount',
        'payment_method',
        'transaction_id',
        'phone',
        'status',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        $methods = [
            'bkash' => 'বিকাশ (bKash)',
            'nagad' => 'নগদ (Nagad)',
            'rocket' => 'রকেট (Rocket)',
            'bank' => 'ব্যাংক স্থানান্তর',
            'cash' => 'সরাসরি নগদ (Cash)',
        ];

        return $methods[$this->payment_method] ?? ucfirst($this->payment_method);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'approved' => '<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> অনুমোদিত</span>',
            'rejected' => '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> প্রত্যাখ্যাত</span>',
            default => '<span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> পর্যালোচনায়</span>',
        };
    }
}
