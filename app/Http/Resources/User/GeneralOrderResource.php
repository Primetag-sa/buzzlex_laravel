<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ProposalResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralOrderResource extends JsonResource
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
            'type' => $this->type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'date' => $this->date,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'proposals_count' => $this->proposals_count,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'proposals' => ProposalResource::collection($this->whenLoaded('proposals')),
        ];
    }
}
