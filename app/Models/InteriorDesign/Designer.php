<?php

namespace App\Models\InteriorDesign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'bio',
        'specialties',
        'qualifications',
        'experience_years',
        'hourly_rate',
        'consultation_fee',
        'profile_image',
        'portfolio_link',
        'certifications',
        'rating',
        'total_projects',
        'total_consultations',
        'is_verified',
        'is_active',
        'is_available',
    ];

    protected $casts = [
        'specialties' => 'array',
        'qualifications' => 'array',
        'certifications' => 'array',
        'experience_years' => 'integer',
        'hourly_rate' => 'decimal:2',
        'consultation_fee' => 'decimal:2',
        'rating' => 'decimal:2',
        'total_projects' => 'integer',
        'total_consultations' => 'integer',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'is_available' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
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

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Accessors
     */
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image ? asset('storage/' . $this->profile_image) : null;
    }
}
