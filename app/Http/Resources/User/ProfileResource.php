<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'location' => [
                'country' => $this->country,
                'city' => $this->city,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]
        ];
    }
}
