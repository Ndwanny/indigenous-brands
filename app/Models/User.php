<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function brand()
    {
        return $this->hasOne(Brand::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBrandOwner(): bool
    {
        return $this->role === 'brand_owner';
    }

    public function hasBrand(): bool
    {
        return $this->brand()->exists();
    }

    public function hasApprovedBrand(): bool
    {
        return $this->brand && $this->brand->status === 'approved';
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeBrandOwners($query)
    {
        return $query->where('role', 'brand_owner');
    }
}
