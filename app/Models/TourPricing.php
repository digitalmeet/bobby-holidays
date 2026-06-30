<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourPricing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tour_pricing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tour_id',
        'label',
        'price_per_person',
        'child_price',
        'infant_price',
        'currency',
        'valid_from',
        'valid_until',
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_per_person' => 'decimal:2',
        'child_price' => 'decimal:2',
        'infant_price' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the tour that owns the pricing.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
