<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'school'       => $this->school,
            'batch_period' => $this->batch_period,
            'photo_url'    => $this->getFirstMediaUrl('photo'),
        ];
    }
}
