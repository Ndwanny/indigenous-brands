<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'brand_id', 'category_id', 'title', 'slug', 'excerpt',
        'body', 'featured_image', 'status', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true)->whereNull('parent_id')->with('replies');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if (! $this->featured_image) return asset('images/image_1.jpg');
        return str_starts_with($this->featured_image, 'http') ? $this->featured_image : asset('storage/' . $this->featured_image);
    }

    public function getPublishedAtFormattedAttribute(): string
    {
        return $this->published_at
            ? $this->published_at->format('F d, Y')
            : $this->created_at->format('F d, Y');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByTag($query, $tagSlug)
    {
        return $query->whereHas('tags', fn($q) => $q->where('slug', $tagSlug));
    }

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
    }
}
