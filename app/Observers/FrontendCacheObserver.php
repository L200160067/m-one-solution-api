<?php

namespace App\Observers;

use App\Jobs\RevalidateFrontendCacheJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FrontendCacheObserver
{
    /**
     * Clear the local cache tags and dispatch frontend revalidation job.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    protected function clearCache(Model $model)
    {
        try {
            // Fase 2: Bersihkan Rumah Sendiri Dulu (Observer Fix)
            $tags = $this->getModelTags($model);
            if (!empty($tags)) {
                Cache::tags($tags)->flush();
                Log::info('Local cache tags cleared.', ['tags' => $tags]);
            }

            // Fase 3 & 4: Asynchronous Webhook with Granular Payload
            RevalidateFrontendCacheJob::dispatch(get_class($model), $model->id, $tags);
        } catch (\Exception $e) {
            Log::error('Exception while clearing cache: ' . $e->getMessage());
        }
    }

    /**
     * Map model class to cache tags.
     */
    protected function getModelTags(Model $model): array
    {
        $class = get_class($model);
        return match ($class) {
            \App\Models\Post::class => ['posts'],
            \App\Models\Setting::class => ['settings'],
            \App\Models\Service::class => ['services'],
            \App\Models\Project::class => ['projects'],
            \App\Models\Testimonial::class => ['testimonials'],
            \App\Models\TeamMember::class => ['team'],
            \App\Models\Partner::class => ['partners'],
            \App\Models\Alumni::class => ['alumni'],
            default => [],
        };
    }

    public function saved(Model $model): void
    {
        $this->clearCache($model);
    }

    public function deleted(Model $model): void
    {
        $this->clearCache($model);
    }

    public function restored(Model $model): void
    {
        $this->clearCache($model);
    }

    public function forceDeleted(Model $model): void
    {
        $this->clearCache($model);
    }
}
