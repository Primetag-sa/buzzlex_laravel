<?php

namespace App\Http\Resources\User;

use App\Http\Resources\MediaResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotographerResource extends JsonResource
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
            'city' => $this->city,
            'country' => $this->country,
            'rate' => $this->rate,
            'image' => new MediaResource($this->getFirstMedia('profile')),
            'services' => ServiceResource::collection($this->whenLoaded('services')),
            'reviews_count' => $this->whenHas('reviews_count'),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'availability' => AvailabilityResource::collection($this->whenLoaded('availability'))
        ];
    }
}
