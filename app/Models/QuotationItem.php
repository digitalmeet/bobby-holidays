<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quotation_id',
        'section_id',
        'sort_order',
        'type',
        'title',
        'description',
        'nights',
        'unit_cost',
        'quantity',
        'total_cost',
        'is_included_in_total',
        'is_optional',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_cost' => 'decimal:2',
        'quantity' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'nights' => 'integer',
        'sort_order' => 'integer',
        'is_included_in_total' => 'boolean',
        'is_optional' => 'boolean',
    ];

    /**
     * Get the quotation that owns this item.
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Get the section that owns this item.
     */
    public function section()
    {
        return $this->belongsTo(QuotationSection::class);
    }
}
