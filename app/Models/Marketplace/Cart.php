<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Methods
     */
    public function addItem($productId, $quantity = 1, $attributes = [])
    {
        $item = $this->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $item = $this->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => Product::find($productId)->final_price,
            ] + $attributes);
        }

        return $item;
    }

    public function updateItemQuantity($itemId, $quantity)
    {
        $item = $this->items()->find($itemId);
        
        if ($item) {
            if ($quantity <= 0) {
                $item->delete();
            } else {
                $item->update(['quantity' => $quantity]);
            }
        }

        return $item;
    }

    public function removeItem($itemId)
    {
        return $this->items()->where('id', $itemId)->delete();
    }

    public function clear()
    {
        return $this->items()->delete();
    }

    /**
     * Accessors
     */
    public function getSubtotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }

    public function getTaxAttribute()
    {
        return $this->subtotal * 0.10; // 10% tax
    }

    public function getTotalAttribute()
    {
        return $this->subtotal + $this->tax;
    }
}
