<?php

namespace App\Http\Resources\Photographer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'is_recommended' => $this->is_recommended,
            'type' => $this->type,
            'features' => PlanFeatureResource::collection($this->features),
            'addons' => PlanAddonResource::collection($this->addons),
            'conditions'=> PlanConditionResource::collection($this->conditions),
            'outputs' => PlanOutputResource::collection($this->outputs)
        ];
    }
}
