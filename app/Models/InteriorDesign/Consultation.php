<?php

namespace App\Models\InteriorDesign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'designer_id',
        'consultation_number',
        'type',
        'title',
        'description',
        'space_type',
        'space_area',
        'budget_range',
        'preferred_style',
        'scheduled_date',
        'scheduled_time',
        'duration',
        'location',
        'meeting_link',
        'status',
        'consultation_fee',
        'is_paid',
        'notes',
    ];

    protected $casts = [
        'space_area' => 'decimal:2',
        'scheduled_date' => 'date',
        'duration' => 'integer',
        'consultation_fee' => 'decimal:2',
        'is_paid' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($consultation) {
            if (!$consultation->consultation_number) {
                $consultation->consultation_number = 'CONS-' . strtoupper(uniqid());
            }
        });
    }
}
