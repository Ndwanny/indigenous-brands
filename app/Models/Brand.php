<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'name', 'slug', 'tagline', 'description',
        'logo', 'cover_image', 'location', 'website_url', 'phone', 'email',
        'facebook_url', 'twitter_url', 'instagram_url', 'status', 'is_featured',
        'rejection_reason',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getLogoUrlAttribute(): string
    {
        if (! $this->logo) return asset('images/logo-default.png');
        return str_starts_with($this->logo, 'http') ? $this->logo : asset('storage/' . $this->logo);
    }

    public function getCoverUrlAttribute(): string
    {
        if (! $this->cover_image) return asset('images/bg_1.jpg');
        return str_starts_with($this->cover_image, 'http') ? $this->cover_image : asset('storage/' . $this->cover_image);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
