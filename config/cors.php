<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | CORS is configured to only allow requests from the frontend domain.
    | In development (Herd): set FRONTEND_URL=http://localhost:3000
    | In staging:            set FRONTEND_URL=http://staging.m-one-solution.com
    | In production:         set FRONTEND_URL=https://m-one-solution.com
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => ['GET', 'OPTIONS'],

    'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:3000')],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type', 'Accept', 'Authorization', 'X-Requested-With'],

    'exposed_headers' => [],

    'max_age' => 3600,

    'supports_credentials' => false,

];
