<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scopes
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Methods
     */
    public static function toggle($userId, $productId)
    {
        $wishlist = static::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return ['action' => 'removed', 'status' => false];
        } else {
            static::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            return ['action' => 'added', 'status' => true];
        }
    }

    public static function check($userId, $productId)
    {
        return static::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();
    }
}
