<?php

namespace App\Http\Resources;

use App\Http\Resources\Photographer\PlanResource;
use App\Http\Resources\User\PhotographerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProposalResource extends JsonResource
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
            'photographer' => new PhotographerResource($this->photographer ),
            'plan' => new PlanResource($this->plan),
            'price' => $this->price,
            'status' => $this->status
        ];
    }
}
