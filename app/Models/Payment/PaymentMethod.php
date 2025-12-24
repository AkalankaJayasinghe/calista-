<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'icon',
        'gateway',
        'configuration',
        'is_active',
        'sort_order',
        'transaction_fee_type',
        'transaction_fee_value',
    ];

    protected $casts = [
        'configuration' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'transaction_fee_value' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Accessors
     */
    public function getIconUrlAttribute()
    {
        return $this->icon ? asset('storage/' . $this->icon) : null;
    }

    /**
     * Methods
     */
    public function calculateFee($amount)
    {
        if ($this->transaction_fee_type === 'percentage') {
            return ($amount * $this->transaction_fee_value) / 100;
        }
        
        return $this->transaction_fee_value ?? 0;
    }
}
