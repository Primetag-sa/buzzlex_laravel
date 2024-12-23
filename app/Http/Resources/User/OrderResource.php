<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Photographer\PlanAddonResource;
use App\Http\Resources\Photographer\PlanResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'date' => $this->date,
            'status' => $this->status,
            'type' => $this->type,
            'photographer' => new PhotographerResource($this->photographer),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'total_price' => $this->total_price,
            'day' => $this->day,
            'plan' => new PlanResource($this->whenLoaded('plan')),
            'addons' => PlanAddonResource::collection($this->whenLoaded('addons')),
        ];
    }
}
