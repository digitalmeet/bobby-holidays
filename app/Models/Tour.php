<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tour extends Model
{
    use HasFactory, SoftDeletes, HasSlug, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'destination_id',
        'slug',
        'title',
        'subtitle',
        'duration_days',
        'duration_nights',
        'overview',
        'highlights',
        'inclusions',
        'exclusions',
        'itinerary',
        'hero_image',
        'gallery',
        'starting_price',
        'price_type',
        'min_group_size',
        'max_group_size',
        'difficulty_level',
        'category',
        'is_featured',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
        'og_image',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'highlights' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'itinerary' => 'array',
        'gallery' => 'array',
        'starting_price' => 'decimal:2',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'min_group_size' => 'integer',
        'max_group_size' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the destination that owns the tour.
     */
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get all pricing for this tour.
     */
    public function pricing()
    {
        return $this->hasMany(TourPricing::class);
    }

    /**
     * Get all enquiries for this tour.
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    /**
     * Get all testimonials for this tour.
     */
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    /**
     * Scope a query to only include active tours.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured tours.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include published tours.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include tours of a specific category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to only include tours for a specific destination.
     */
    public function scopeByDestination($query, $destinationId)
    {
        return $query->where('destination_id', $destinationId);
    }

    /**
     * Scope a query to order by sort_order and title.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')
            ->orderBy('title');
    }
}
