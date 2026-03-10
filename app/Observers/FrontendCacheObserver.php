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
            // Fase 2: Bersihkan Rumah Sendiri Dulu (Cache Version Bugfix)
            $versionKey = $this->getModelVersionKey($model);
            $tags = []; // Array tags untuk RevalidateFrontendCacheJob tetap kosong dulu atau ditiadakan 
            
            if ($versionKey) {
                Cache::put($versionKey, time());
                Log::info('Local cache version bumped.', ['version_key' => $versionKey]);
                // Supaya payload webhook Next.js tetap memiliki nilai 'tags' sebagai identifier entitas
                $tags = [str_replace('_version', '', $versionKey)];
            }

            // Fase 3 & 4: Asynchronous Webhook with Granular Payload
            RevalidateFrontendCacheJob::dispatch(get_class($model), $model->id, $tags);
        } catch (\Exception $e) {
            Log::error('Exception while clearing cache: ' . $e->getMessage());
        }
    }

    /**
     * Map model class to cache version key.
     */
    protected function getModelVersionKey(Model $model): ?string
    {
        $class = get_class($model);
        return match ($class) {
            \App\Models\Post::class => 'posts_version',
            \App\Models\Setting::class => 'settings_version',
            \App\Models\Service::class => 'services_version',
            \App\Models\Project::class => 'projects_version',
            \App\Models\Testimonial::class => 'testimonials_version',
            \App\Models\TeamMember::class => 'team_version',
            \App\Models\Partner::class => 'partners_version',
            \App\Models\Alumni::class => 'alumni_version',
            default => null,
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
