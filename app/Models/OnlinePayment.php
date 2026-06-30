<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    protected $fillable = [
        'booking_id',
        'quotation_id',
        'gateway',
        'order_id',
        'payment_id',
        'signature',
        'amount',
        'currency',
        'status',
        'client_name',
        'client_email',
        'client_phone',
        'notes',
        'gateway_response',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gateway_response' => 'array',
        'paid_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function scopeCaptured($query)
    {
        return $query->where('status', 'captured');
    }
}
