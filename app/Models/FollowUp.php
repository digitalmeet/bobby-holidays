<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'enquiry_id',
        'created_by',
        'type',
        'status',
        'notes',
        'scheduled_at',
        'completed_at',
        'next_follow_up_at',
        'duration_seconds',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
        'next_follow_up_at' => 'datetime',
        'duration_seconds' => 'integer',
    ];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('scheduled_at', today());
    }

    public function scopeOverdue($query)
    {
        return $query->where('scheduled_at', '<', now())
            ->whereNull('completed_at');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('scheduled_at', '>=', now())
            ->whereNull('completed_at');
    }

    public function scopePending($query)
    {
        return $query->whereNull('completed_at');
    }
}
