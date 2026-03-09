<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'excerpt'      => $this->excerpt,
            'content'      => $this->when($request->routeIs('api.posts.show'), $this->content),
            'category'     => $this->whenLoaded('category', fn () => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),
            'author'       => $this->whenLoaded('author', fn () => $this->author?->name),
            'cover_url'    => $this->getFirstMediaUrl('cover'),
            'cover_thumb'  => $this->getFirstMediaUrl('cover', 'thumb'),
            'published_at' => $this->published_at?->toISOString(),
            'created_at'   => $this->created_at->toISOString(),
        ];
    }
}
