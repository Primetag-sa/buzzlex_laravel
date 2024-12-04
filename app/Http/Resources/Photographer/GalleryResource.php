<?php

namespace App\Http\Resources\Photographer;

use App\Http\Resources\MediaResource;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'service' => new ServiceResource($this->service),
            'images' => MediaResource::collection($this->getMedia('gallery'))
        ];
    }
}
