<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Define the 'api' rate limiter — used by throttle:api middleware
        // Limit: 60 requests per minute per IP address
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });

        // Register observer to clear Next.js frontend cache
        \App\Models\Alumni::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\Category::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\Partner::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\Post::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\Project::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\Service::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\Setting::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\TeamMember::observe(\App\Observers\FrontendCacheObserver::class);
        \App\Models\Testimonial::observe(\App\Observers\FrontendCacheObserver::class);
    }
}
