<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSyllabusProgress extends Model
{
    use HasFactory;

    protected $table = 'user_syllabus_progress';

    protected $fillable = [
        'user_id',
        'tier',
        'item_key',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
