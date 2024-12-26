<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'screen' => $this->screen,
            'filters' => $this->filters,
            'type' => $this->type,
            'media' => new MediaResource($this->getFirstMedia('image'))
        ];
    }
}
