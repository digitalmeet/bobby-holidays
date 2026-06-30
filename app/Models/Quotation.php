<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Quotation extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'public_id',
        'access_token',
        'enquiry_id',
        'version',
        'parent_quotation_id',
        'client_name',
        'client_email',
        'client_phone',
        'title',
        'travel_date',
        'return_date',
        'adults',
        'children',
        'infants',
        'currency',
        'subtotal_amount',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'validity_date',
        'status',
        'personalised_message',
        'internal_notes',
        'terms_and_conditions',
        'prepared_by',
        'sent_at',
        'viewed_at',
        'view_count',
        'accepted_at',
        'rejected_at',
        'rejection_reason',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'travel_date' => 'date',
        'return_date' => 'date',
        'validity_date' => 'date',
        'adults' => 'integer',
        'children' => 'integer',
        'infants' => 'integer',
        'subtotal_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'version' => 'integer',
        'view_count' => 'integer',
        'sent_at' => 'datetime',
        'viewed_at' => 'datetime',
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Quotation $quotation) {
            // Generate unique public_id (12 characters)
            do {
                $quotation->public_id = strtoupper(Str::random(12));
            } while (self::where('public_id', $quotation->public_id)->exists());

            // Generate unique access_token (64 characters) - for future secure links
            do {
                $quotation->access_token = Str::random(64);
            } while (self::where('access_token', $quotation->access_token)->exists());
        });
    }

    /**
     * Get the enquiry that this quotation is for.
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    /**
     * Get the user who prepared this quotation.
     */
    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    /**
     * Get the parent quotation (for versioning).
     */
    public function parentQuotation()
    {
        return $this->belongsTo(Quotation::class, 'parent_quotation_id');
    }

    /**
     * Get all version quotations (child quotations).
     */
    public function versions()
    {
        return $this->hasMany(Quotation::class, 'parent_quotation_id');
    }

    /**
     * Get all sections in this quotation.
     */
    public function sections()
    {
        return $this->hasMany(QuotationSection::class);
    }

    /**
     * Get all items in this quotation.
     */
    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    /**
     * Get all history entries for this quotation.
     */
    public function histories()
    {
        return $this->hasMany(QuotationHistory::class);
    }

    /**
     * Scope a query to only include quotations with a specific status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include sent quotations.
     */
    public function scopeSent($query)
    {
        return $query->whereNotNull('sent_at')
            ->where('status', 'sent');
    }

    /**
     * Scope a query to only include accepted quotations.
     */
    public function scopeAccepted($query)
    {
        return $query->whereNotNull('accepted_at')
            ->where('status', 'accepted');
    }

    /**
     * Scope a query to only include expired quotations.
     */
    public function scopeExpired($query)
    {
        return $query->whereNotNull('validity_date')
            ->where('validity_date', '<', now())
            ->where('status', '!=', 'accepted');
    }

    /**
     * Scope a query to only include valid quotations (not expired).
     */
    public function scopeValid($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('validity_date')
                ->orWhere('validity_date', '>=', now());
        });
    }
}
