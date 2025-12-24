<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'installment_number',
        'amount',
        'due_date',
        'paid_amount',
        'paid_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];

    /**
     * Relationships
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'pending')
            ->where('due_date', '<', now());
    }

    /**
     * Accessors
     */
    public function getIsOverdueAttribute()
    {
        return $this->status === 'pending' && $this->due_date < now();
    }

    public function getRemainingAmountAttribute()
    {
        return $this->amount - ($this->paid_amount ?? 0);
    }

    /**
     * Methods
     */
    public function markAsPaid($amount = null)
    {
        $this->update([
            'paid_amount' => $amount ?? $this->amount,
            'paid_date' => now(),
            'status' => 'paid',
        ]);
    }
}
