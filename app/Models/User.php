<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_admin',
        'is_seller',
        'is_customer',
        'profile_image',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_seller' => 'boolean',
        'is_customer' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function seller()
    {
        return $this->hasOne(\App\Models\Seller\Seller::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Marketplace\Order::class);
    }

    public function cart()
    {
        return $this->hasOne(\App\Models\Marketplace\Cart::class);
    }

    public function wishlist()
    {
        return $this->hasMany(\App\Models\Marketplace\Wishlist::class);
    }

    public function addresses()
    {
        return $this->hasMany(\App\Models\Common\Address::class);
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\Marketplace\Review::class);
    }

    public function customRequests()
    {
        return $this->hasMany(\App\Models\CustomFurniture\CustomRequest::class);
    }

    public function consultations()
    {
        return $this->hasMany(\App\Models\InteriorDesign\Consultation::class);
    }
}
