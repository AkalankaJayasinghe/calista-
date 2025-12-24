<?php

namespace App\Models\CustomFurniture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomQuotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_request_id',
        'workshop_id',
        'quotation_number',
        'material_cost',
        'labor_cost',
        'other_costs',
        'total_cost',
        'estimated_days',
        'description',
        'terms_and_conditions',
        'valid_until',
        'status',
        'notes',
    ];

    protected $casts = [
        'material_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'other_costs' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'estimated_days' => 'integer',
        'valid_until' => 'date',
    ];

    /**
     * Relationships
     */
    public function customRequest()
    {
        return $this->belongsTo(CustomRequest::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            if (!$quotation->quotation_number) {
                $quotation->quotation_number = 'QUO-' . strtoupper(uniqid());
            }
        });
    }
}
