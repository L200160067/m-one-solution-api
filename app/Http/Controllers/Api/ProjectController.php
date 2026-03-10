<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $featured = $request->boolean('featured');
        $version = Cache::get('projects_version', '1');
        $cacheKey = "projects.{$version}.index." . ($featured ? 'featured' : 'all');

        $data = Cache::remember($cacheKey, 3600, function () use ($featured) {
            return Project::with('media')
                ->when($featured, fn ($q) => $q->featured())
                ->orderBy('order_column')
                ->get();
        });

        return ProjectResource::collection($data);
    }
}
