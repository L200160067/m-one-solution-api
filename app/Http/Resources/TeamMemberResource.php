<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamMemberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'role'             => $this->role,
            'social_linkedin'  => $this->social_linkedin,
            'social_github'    => $this->social_github,
            'social_instagram' => $this->social_instagram,
            'avatar_url'       => $this->getFirstMediaUrl('avatar'),
        ];
    }
}
