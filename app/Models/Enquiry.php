<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tour_id',
        'destination_id',
        'name',
        'email',
        'phone',
        'country',
        'travel_date',
        'flexible_dates',
        'duration_days',
        'adults',
        'children',
        'infants',
        'budget_range',
        'message',
        'status',
        'source',
        'assigned_to',
        'last_contacted_at',
        'follow_up_at',
        'internal_notes',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'travel_date' => 'date',
        'flexible_dates' => 'boolean',
        'duration_days' => 'integer',
        'adults' => 'integer',
        'children' => 'integer',
        'infants' => 'integer',
        'last_contacted_at' => 'datetime',
        'follow_up_at' => 'datetime',
    ];

    /**
     * Get the tour that this enquiry is for.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get the destination that this enquiry is for.
     */
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the user assigned to this enquiry.
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all quotations for this enquiry.
     */
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    /**
     * Get all follow-ups for this enquiry.
     */
    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    /**
     * Scope a query to only include enquiries with a specific status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include pending enquiries.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'new')
            ->orWhere('status', 'contacted');
    }

    /**
     * Scope a query to only include enquiries assigned to a specific user.
     */
    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    /**
     * Scope a query to only include enquiries with follow-ups due.
     */
    public function scopeFollowUpsDue($query)
    {
        return $query->whereNotNull('follow_up_at')
            ->where('follow_up_at', '<=', now())
            ->where('status', '!=', 'converted')
            ->where('status', '!=', 'lost');
    }
}
