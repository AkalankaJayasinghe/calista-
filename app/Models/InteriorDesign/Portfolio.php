<?php

namespace App\Models\InteriorDesign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'designer_id',
        'title',
        'description',
        'project_type',
        'space_area',
        'location',
        'completion_date',
        'client_name',
        'images',
        'featured_image',
        'tags',
        'is_featured',
        'is_published',
        'view_count',
    ];

    protected $casts = [
        'space_area' => 'decimal:2',
        'completion_date' => 'date',
        'images' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'view_count' => 'integer',
    ];

    /**
     * Relationships
     */
    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    public function category()
    {
        return $this->belongsTo(DesignCategory::class, 'design_category_id');
    }

    /**
     * Scopes
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Accessors
     */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : null;
    }

    /**
     * Methods
     */
    public function incrementViews()
    {
        $this->increment('view_count');
    }
}
