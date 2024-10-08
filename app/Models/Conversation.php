<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Conversation extends Model
{
    use HasFactory;
    
    protected $dates = [
        'created_at',
        'updated_at',
        'last_activity_at',
    ];

    const STATUS_IN_PROGRESS = 'inProgress';
    const STATUS_EXPIRED = 'expired';
    const STATUS_CANCELED = 'canceled';
    const STATUS_COMPLETED = 'completed';
    
    const AGENT_STATUS_THINKING = 'thinking';
    const AGENT_STATUS_REACTED = 'reacted';

    protected $fillable = ['user_id', 'status', 'last_activity_at', 'agent_status', 'feedback_score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(ConversationMessage::class);
    }

    public function checkAndUpdateExpired()
    {
        if ($this->status === self::STATUS_IN_PROGRESS) {
            $inactiveTime = $this->freshTimestamp()->diffInMinutes($this->last_activity_at);
            if ($inactiveTime >= 30) {
                $this->update(['status' => self::STATUS_EXPIRED]);
                Log::info('Conversation status set to expired for conversation ID: ' . $this->id);
            }
        }
    }

    public function markAsCompleted()
    {
        $this->update(['status' => self::STATUS_COMPLETED]);
        Log::info('Conversation status set to completed for conversation ID: ' . $this->id);
    }

    public function markAsCanceled()
    {
        $this->update(['status' => self::STATUS_CANCELED]);
        Log::info('Conversation status set to canceled for conversation ID: ' . $this->id);
    }

    public function setAgentStatusThinking()
    {
        $this->update(['agent_status' => self::AGENT_STATUS_THINKING]);
        Log::info('Agent status set to thinking for conversation ID: ' . $this->id);
    }

    public function setAgentStatusReacted()
    {
        $this->update(['agent_status' => self::AGENT_STATUS_REACTED]);
        Log::info('Agent status set to reacted for conversation ID: ' . $this->id);
    }
}
