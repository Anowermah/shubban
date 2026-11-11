<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIChatMessage extends Model
{
    protected $table = 'ai_chat_messages';

    protected $fillable = [
        'session_id',
        'user_ip',
        'user_message',
        'bot_response',
        'provider_used',
        'matched_knowledge_id',
        'was_helpful',
        'is_resolved',
    ];

    protected $casts = [
        'was_helpful' => 'boolean',
        'is_resolved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function knowledgeBase()
    {
        return $this->belongsTo(AIChatKnowledgeBase::class, 'matched_knowledge_id');
    }
}
