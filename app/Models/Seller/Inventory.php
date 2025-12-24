<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'product_id',
        'sku',
        'quantity',
        'reserved_quantity',
        'location',
        'last_restocked_at',
        'low_stock_threshold',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'reserved_quantity' => 'integer',
        'low_stock_threshold' => 'integer',
        'last_restocked_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Marketplace\Product::class);
    }

    /**
     * Accessors
     */
    public function getAvailableQuantityAttribute()
    {
        return $this->quantity - $this->reserved_quantity;
    }

    public function getIsLowStockAttribute()
    {
        return $this->available_quantity <= $this->low_stock_threshold;
    }

    /**
     * Scopes
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('(quantity - reserved_quantity) <= low_stock_threshold');
    }

    public function scopeOutOfStock($query)
    {
        return $query->whereRaw('(quantity - reserved_quantity) <= 0');
    }

    /**
     * Methods
     */
    public function reserve($quantity)
    {
        if ($this->available_quantity >= $quantity) {
            $this->increment('reserved_quantity', $quantity);
            return true;
        }
        return false;
    }

    public function releaseReserved($quantity)
    {
        $this->decrement('reserved_quantity', $quantity);
    }

    public function restock($quantity)
    {
        $this->increment('quantity', $quantity);
        $this->update(['last_restocked_at' => now()]);
    }
}
