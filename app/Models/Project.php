<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia, \App\Traits\PingsNextJsWebhook;

    public $nextJsCacheTag = 'projects';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'client_name',
        'project_url',
        'is_featured',
        'order_column',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->useDisk('public')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->width(800)
            ->height(600)
            ->nonQueued();

        $this->addMediaConversion('webp')
            ->format('webp')
            ->width(1200)
            ->height(900)
            ->nonQueued();
    }

    public function scopeFeatured($query)
    {
        return $query->whereRaw('is_featured = true');
    }
}
