<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIAdminAction extends Model
{
    use HasFactory;

    protected $table = 'ai_admin_actions';

    protected $fillable = [
        'admin_id',
        'prompt',
        'action_type',
        'summary',
        'payload_before',
        'payload_after',
        'is_rolled_back',
    ];

    protected $casts = [
        'payload_before' => 'array',
        'payload_after' => 'array',
        'is_rolled_back' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
