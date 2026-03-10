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
        'title', 'slug', 'category', 'description',
        'client_name', 'project_url', 'is_featured', 'order_column',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(800)->height(600);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
