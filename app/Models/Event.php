<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'description', 'featured_image',
        'location', 'venue', 'event_date', 'start_time', 'end_time',
        'price', 'is_free', 'event_type', 'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_free' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return $this->is_free ? 'Free' : 'K' . number_format($this->price, 2);
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->event_date->format('M d, Y');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : asset('images/image_1.jpg');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString())
                     ->where('status', 'upcoming');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('event_type', $type);
    }
}
