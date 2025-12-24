<?php

namespace App\Models\CustomFurniture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_request_id',
        'workshop_id',
        'title',
        'description',
        'design_file',
        '3d_model_file',
        'technical_drawing',
        'materials_list',
        'estimated_cost',
        'is_approved',
        'approved_at',
        'notes',
    ];

    protected $casts = [
        'materials_list' => 'array',
        'estimated_cost' => 'decimal:2',
        'is_approved' => 'boolean',
        'approved_at' => 'datetime',
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
     * Accessors
     */
    public function getDesignFileUrlAttribute()
    {
        return $this->design_file ? asset('storage/' . $this->design_file) : null;
    }

    public function getModel3dUrlAttribute()
    {
        return $this->{'3d_model_file'} ? asset('storage/' . $this->{'3d_model_file'}) : null;
    }

    public function getTechnicalDrawingUrlAttribute()
    {
        return $this->technical_drawing ? asset('storage/' . $this->technical_drawing) : null;
    }
}
