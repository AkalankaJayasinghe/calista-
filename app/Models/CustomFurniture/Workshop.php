<?php

namespace App\Models\CustomFurniture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_name',
        'email',
        'phone',
        'address',
        'city',
        'description',
        'specialties',
        'logo',
        'images',
        'rating',
        'total_projects',
        'is_verified',
        'is_active',
    ];

    protected $casts = [
        'specialties' => 'array',
        'images' => 'array',
        'rating' => 'decimal:2',
        'total_projects' => 'integer',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function quotations()
    {
        return $this->hasMany(CustomQuotation::class);
    }

    public function orders()
    {
        return $this->hasMany(CustomOrder::class);
    }

    public function designs()
    {
        return $this->hasMany(Design::class);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Accessors
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }
}
