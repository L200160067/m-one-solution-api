<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'category'          => $this->category,
            'short_description' => $this->short_description,
            'full_description'  => $this->full_description,
            'features'          => $this->features ?? [],
            'benefits'          => $this->benefits ?? [],
            'keywords'          => $this->keywords ?? [],
            'image_url'         => $this->getFirstMediaUrl('image'),
            'image_thumb'       => $this->getFirstMediaUrl('image', 'thumb'),
        ];
    }
}
