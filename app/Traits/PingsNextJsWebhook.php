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
                $webhookUrl = config('services.frontend.revalidate_url');
                $tag = $model->nextJsCacheTag ?? $model->getTable();

                Http::withOptions([
                    'curl' => [CURLOPT_SSLVERSION => config('services.curl_ssl_version')],
                ])->post($webhookUrl, [
                    'secret' => config('services.frontend.revalidate_secret'),
                    'type' => 'tag',
                    'payload' => $tag,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to ping Next.js Webhook for '.class_basename($model).': '.$e->getMessage());
            }
        };

        static::saved($revalidateNextJs);
        static::deleted($revalidateNextJs);
    }
}
