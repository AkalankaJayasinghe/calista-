<?php

namespace App\Models\InteriorDesign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'user_id',
        'designer_id',
        'project_number',
        'title',
        'description',
        'project_type',
        'space_area',
        'budget',
        'start_date',
        'expected_end_date',
        'actual_end_date',
        'status',
        'progress_percentage',
        'notes',
    ];

    protected $casts = [
        'space_area' => 'decimal:2',
        'budget' => 'decimal:2',
        'start_date' => 'date',
        'expected_end_date' => 'date',
        'actual_end_date' => 'date',
        'progress_percentage' => 'integer',
    ];

    /**
     * Relationships
     */
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
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
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (!$project->project_number) {
                $project->project_number = 'PROJ-' . strtoupper(uniqid());
            }
        });
    }
}
