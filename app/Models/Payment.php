<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'online_payment_id',
        'amount',
        'currency',
        'method',
        'reference_number',
        'payment_date',
        'status',
        'notes',
        'receipt_path',
        'recorded_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::updating(function (Payment $payment): void {
            if (!app()->runningInConsole() && auth()->check() && !auth()->user()->isSuperAdmin()) {
                throw new AuthorizationException('Only a super administrator can amend a recorded payment.');
            }
        });
    }

    /**
     * Get the booking that this payment is for.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function onlinePayment()
    {
        return $this->belongsTo(OnlinePayment::class);
    }

    /**
     * Get the user who recorded this payment.
     */
    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Get all history entries for this payment.
     */
    public function histories()
    {
        return $this->hasMany(PaymentHistory::class);
    }

    /**
     * Scope a query to only include received payments.
     */
    public function scopeReceived($query)
    {
        return $query->where('status', 'received');
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include refunded payments.
     */
    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }
}
