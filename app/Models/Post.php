<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Post extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected static function booted()
    {
        $revalidateNextJs = function () {
            try {
                // Next.js Webhook URL
                $webhookUrl = env('NEXT_JS_URL', 'http://localhost:3000') . '/api/revalidate';
                
                Http::post($webhookUrl, [
                    'secret' => env('NEXT_REVALIDATE_SECRET', 'change-me-to-a-strong-secret'),
                    'tags' => ['posts'] // Optional Next.js 14 tag revalidation
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to ping Next.js Webhook: ' . $e->getMessage());
            }
        };

        static::saved($revalidateNextJs);
        static::deleted($revalidateNextJs);
    }

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'category_id', 'author_id', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->sharpen(10);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
