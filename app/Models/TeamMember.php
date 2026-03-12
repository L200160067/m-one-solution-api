<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class TeamMember extends Model implements HasMedia
{
    use InteractsWithMedia, \App\Traits\PingsNextJsWebhook;

    public $nextJsCacheTag = 'team';

    protected $fillable = [
        'name', 'role', 'social_linkedin',
        'social_github', 'social_instagram', 'order_column',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->useDisk('public')->singleFile();
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->width(600)
            ->height(600)
            ->nonQueued();
    }
}
