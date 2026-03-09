<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // CORS: restrict to frontend domain only
        $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);

        // JSON-only on API: ensures all /api/* errors return JSON, not HTML
        $middleware->api(append: []);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Standardize all API error responses to JSON
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                $status = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface
                    ? $e->getStatusCode()
                    : 500;

                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: Response::$statusTexts[$status] ?? 'Server Error',
                ], $status);
            }
        });
    })->create();
