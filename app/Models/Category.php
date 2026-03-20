<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'type'];

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function scopeForBrands($query)
    {
        return $query->where('type', 'brand');
    }

    public function scopeForBlog($query)
    {
        return $query->where('type', 'blog');
    }

    public function scopeForEvents($query)
    {
        return $query->where('type', 'event');
    }
}
