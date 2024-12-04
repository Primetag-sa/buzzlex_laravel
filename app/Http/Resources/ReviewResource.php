<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'city' => $this->user->city
            ],
            'photographer' => [
                'id' => $this->photographer->id,
                'name' => $this->photographer->name,
                'city' => $this->photographer->city
            ],
            'rate' => $this->rate
        ];
    }
}
