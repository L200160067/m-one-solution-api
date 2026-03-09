<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'category'    => $this->category,
            'description' => $this->description,
            'client_name' => $this->client_name,
            'project_url' => $this->project_url,
            'is_featured' => $this->is_featured,
            'image_url'   => $this->getFirstMediaUrl('image'),
            'image_thumb' => $this->getFirstMediaUrl('image', 'thumb'),
        ];
    }
}
