<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'role'       => $this->role,
            'company'    => $this->company,
            'content'    => $this->content,
            'rating'     => $this->rating,
            'avatar_url' => $this->getFirstMediaUrl('avatar'),
        ];
    }
}
