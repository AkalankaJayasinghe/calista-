<?php

namespace App\Models\CustomFurniture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'furniture_type',
        'title',
        'description',
        'dimensions',
        'preferred_material',
        'preferred_color',
        'budget_range',
        'reference_images',
        'deadline',
        'status',
        'notes',
    ];

    protected $casts = [
        'dimensions' => 'array',
        'reference_images' => 'array',
        'deadline' => 'date',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function quotations()
    {
        return $this->hasMany(CustomQuotation::class);
    }

    public function order()
    {
        return $this->hasOne(CustomOrder::class);
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeQuoted($query)
    {
        return $query->where('status', 'quoted');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
