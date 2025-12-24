<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'document_type',
        'document_number',
        'document_file',
        'status',
        'notes',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'verified_by');
    }

    /**
     * Accessors
     */
    public function getDocumentUrlAttribute()
    {
        return $this->document_file ? asset('storage/' . $this->document_file) : null;
    }

    /**
     * Scopes
     */
    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
