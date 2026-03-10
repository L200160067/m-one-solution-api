<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait PingsNextJsWebhook
{
    protected static function bootPingsNextJsWebhook()
    {
        $revalidateNextJs = function ($model) {
            try {
                $webhookUrl = env('NEXTJS_URL', 'http://localhost:3000') . '/api/revalidate';
                $tag = $model->nextJsCacheTag ?? $model->getTable();
                
                Http::post($webhookUrl, [
                    'secret' => env('NEXTJS_REVALIDATE_SECRET', 'my-secret-token'),
                    'type' => 'tag',
                    'payload' => $tag
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to ping Next.js Webhook for ' . class_basename($model) . ': ' . $e->getMessage());
            }
        };

        static::saved($revalidateNextJs);
        static::deleted($revalidateNextJs);
    }
}
