<?php

namespace App\Models\CustomFurniture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'unit',
        'price_per_unit',
        'stock_quantity',
        'image',
        'properties',
        'is_available',
    ];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
        'stock_quantity' => 'integer',
        'properties' => 'array',
        'is_available' => 'boolean',
    ];

    /**
     * Scopes
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('stock_quantity', '>', 0);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Accessors
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
