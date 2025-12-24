<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'file_name',
        'file_path',
        'file_type',
        'mime_type',
        'size',
        'disk',
        'collection',
        'alt_text',
        'title',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'size' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Relationships
     */
    public function mediable()
    {
        return $this->morphTo();
    }

    /**
     * Scopes
     */
    public function scopeByCollection($query, $collection)
    {
        return $query->where('collection', $collection);
    }

    public function scopeImages($query)
    {
        return $query->where('file_type', 'image');
    }

    public function scopeDocuments($query)
    {
        return $query->where('file_type', 'document');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Accessors
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    public function getSizeFormattedAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Methods
     */
    public function isImage()
    {
        return $this->file_type === 'image';
    }

    public function isDocument()
    {
        return $this->file_type === 'document';
    }

    public function isVideo()
    {
        return $this->file_type === 'video';
    }
}
