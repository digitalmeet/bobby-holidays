<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_ref',
        'quotation_id',
        'enquiry_id',
        'tour_id',
        'client_name',
        'client_email',
        'client_phone',
        'travel_date',
        'return_date',
        'adults',
        'children',
        'infants',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'currency',
        'status',
        'cancellation_reason',
        'cancelled_at',
        'special_requests',
        'internal_notes',
        'assigned_to',
        'gst_number',
        'gst_amount',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'travel_date' => 'date',
        'return_date' => 'date',
        'adults' => 'integer',
        'children' => 'integer',
        'infants' => 'integer',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'cancelled_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Booking $booking) {
            $booking->booking_ref = self::generateBookingRef();
        });
    }

    private static function generateBookingRef(): string
    {
        $year = (int) now()->format('Y');

        return DB::transaction(function () use ($year) {
            $sequence = DB::table('booking_sequences')
                ->where('year', $year)
                ->lockForUpdate()
                ->first();

            if ($sequence) {
                $nextNumber = $sequence->last_number + 1;
                DB::table('booking_sequences')
                    ->where('year', $year)
                    ->update(['last_number' => $nextNumber]);
            } else {
                $nextNumber = 1;
                DB::table('booking_sequences')->insert([
                    'year' => $year,
                    'last_number' => $nextNumber,
                ]);
            }

            return sprintf('UW-%d-%06d', $year, $nextNumber);
        });
    }

    /**
     * Get the quotation that this booking is based on.
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Get the enquiry that this booking originated from.
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    /**
     * Get the tour for this booking.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get the user assigned to this booking.
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all travellers for this booking.
     */
    public function travellers()
    {
        return $this->hasMany(Traveller::class);
    }

    /**
     * Get all payments for this booking.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get all status history entries for this booking.
     */
    public function statusHistories()
    {
        return $this->hasMany(BookingStatusHistory::class);
    }

    /**
     * Scope a query to only include bookings with a specific status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include upcoming bookings.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('travel_date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'refunded');
    }

    /**
     * Scope a query to only include cancelled bookings.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
