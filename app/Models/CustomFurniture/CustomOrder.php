<?php

namespace App\Models\CustomFurniture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_request_id',
        'custom_quotation_id',
        'user_id',
        'workshop_id',
        'order_number',
        'total_amount',
        'paid_amount',
        'payment_status',
        'production_status',
        'start_date',
        'expected_completion_date',
        'actual_completion_date',
        'delivery_address',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'start_date' => 'date',
        'expected_completion_date' => 'date',
        'actual_completion_date' => 'date',
    ];

    /**
     * Relationships
     */
    public function customRequest()
    {
        return $this->belongsTo(CustomRequest::class);
    }

    public function quotation()
    {
        return $this->belongsTo(CustomQuotation::class, 'custom_quotation_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function payments()
    {
        return $this->morphMany(\App\Models\Payment\Payment::class, 'payable');
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('production_status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('production_status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('production_status', 'completed');
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->order_number) {
                $order->order_number = 'CUST-' . strtoupper(uniqid());
            }
        });
    }
}
