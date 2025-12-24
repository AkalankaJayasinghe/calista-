<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'business_registration_number',
        'tax_id',
        'description',
        'logo',
        'banner',
        'phone',
        'email',
        'website',
        'status',
        'is_verified',
        'verification_date',
        'rating',
        'total_sales',
        'commission_rate',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verification_date' => 'datetime',
        'rating' => 'decimal:2',
        'total_sales' => 'decimal:2',
        'commission_rate' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Marketplace\Product::class);
    }

    public function profile()
    {
        return $this->hasOne(SellerProfile::class);
    }

    public function documents()
    {
        return $this->hasMany(SellerDocument::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(
            \App\Models\Marketplace\Order::class,
            \App\Models\Marketplace\OrderItem::class,
            'seller_id',
            'id',
            'id',
            'order_id'
        );
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Accessors
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    public function getBannerUrlAttribute()
    {
        return $this->banner ? asset('storage/' . $this->banner) : null;
    }

    public function getTotalProductsAttribute()
    {
        return $this->products()->count();
    }

    public function getActiveProductsAttribute()
    {
        return $this->products()->active()->count();
    }
}
