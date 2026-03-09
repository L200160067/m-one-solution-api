<?php

namespace App\Observers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class FrontendCacheObserver
{
    /**
     * Clear the frontend cache for the model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    protected function clearCache(Model $model)
    {
        try {
            $url = config('services.frontend.revalidate_url');
            $secret = config('services.frontend.revalidate_secret');

            if ($url && $secret) {
                $response = Http::get($url, [
                    'secret' => $secret
                ]);

                if ($response->failed()) {
                    Log::error('Failed to clear frontend cache', [
                        'model' => get_class($model),
                        'id' => $model->id ?? null,
                        'url' => $url,
                        'status' => $response->status(),
                        'body' => $response->body()
                    ]);
                } else {
                    Log::info('Frontend cache cleared successfully.', [
                        'model' => get_class($model),
                        'id' => $model->id ?? null,
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Exception while clearing frontend cache: ' . $e->getMessage());
        }
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
