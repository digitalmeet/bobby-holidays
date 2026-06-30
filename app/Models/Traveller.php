<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traveller extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'type',
        'title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'passport_number',
        'passport_expiry',
        'nationality',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'passport_expiry' => 'date',
    ];

    /**
     * Get the booking that owns this traveller.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
