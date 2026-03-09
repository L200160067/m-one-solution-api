<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'posts.index.' . md5(serialize($request->query()));

        $data = Cache::remember($cacheKey, 3600, function () use ($request) {
            return Post::with(['category', 'media'])
                ->published()
                ->when($request->category, fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $request->category)))
                ->orderByDesc('published_at')
                ->paginate(12);
        });

        return PostResource::collection($data);
    }

    public function show(string $slug)
    {
        $cacheKey = 'posts.show.' . $slug;

        $post = Cache::remember($cacheKey, 3600, function () use ($slug) {
            return Post::with(['category', 'author', 'media'])
                ->published()
                ->where('slug', $slug)
                ->firstOrFail();
        });

        return new PostResource($post);
    }
}
