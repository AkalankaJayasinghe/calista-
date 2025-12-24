<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'attributes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'attributes' => 'array',
    ];

    /**
     * Relationships
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Accessors
     */
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function getProductNameAttribute()
    {
        return $this->product?->name;
    }

    public function getProductImageAttribute()
    {
        return $this->product?->images()->primary()->first()?->image_url;
    }
}
