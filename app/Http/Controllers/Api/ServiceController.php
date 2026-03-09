<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    public function index()
    {
        $data = Cache::remember('services.index', 3600, function () {
            return Service::with('media')->orderBy('order_column')->get();
        });

        return ServiceResource::collection($data);
    }

    public function show(string $slug)
    {
        $service = Cache::remember('services.show.' . $slug, 3600, function () use ($slug) {
            return Service::with('media')->where('slug', $slug)->firstOrFail();
        });

        return new ServiceResource($service);
    }
}
