<?php

namespace App\Http\Resources\Photographer;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'message' => $this->message,
            'media' => MediaResource::collection($this->getMedia('images')),
            'record' => new MediaResource($this->getFirstMedia('record')),
            'created_at' => $this->created_at,
            'read_at' => $this->read_at
        ];
    }
}
