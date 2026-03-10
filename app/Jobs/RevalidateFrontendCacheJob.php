<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RevalidateFrontendCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $modelClass;
    public $modelId;
    public $tags;

    /**
     * Create a new job instance.
     */
    public function __construct(string $modelClass, $modelId, array $tags = [])
    {
        $this->modelClass = $modelClass;
        $this->modelId = $modelId;
        $this->tags = $tags;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $url = config('services.frontend.revalidate_url');
            $secret = config('services.frontend.revalidate_secret');

            if ($url && $secret) {
                // Fase 4 Granular Revalidation Payload
                $payload = [
                    'secret' => $secret,
                    'model' => class_basename($this->modelClass),
                    'id' => $this->modelId,
                    'tags' => $this->tags
                ];

                $response = Http::post($url, $payload);

                if ($response->failed()) {
                    Log::error('Failed to clear frontend cache', [
                        'model' => $this->modelClass,
                        'id' => $this->modelId,
                        'url' => $url,
                        'status' => $response->status(),
                        'body' => $response->body()
                    ]);
                } else {
                    Log::info('Frontend cache cleared successfully.', [
                        'model' => $this->modelClass,
                        'id' => $this->modelId,
                        'tags' => $this->tags
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Exception while clearing frontend cache: ' . $e->getMessage());
        }
    }
}
