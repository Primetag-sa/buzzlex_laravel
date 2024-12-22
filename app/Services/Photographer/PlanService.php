<?php

namespace App\Services\Photographer;

use Illuminate\Support\Arr;

class PlanService
{
    public function handleOutputs($plan, $outputs = [], $is_update = false)
    {
        if($is_update){
            $plan->outputs()->delete();
        }
        foreach($outputs as $output)
        {
            $createdOutput = $plan->outputs()->create($output);
            if(key_exists('images', $output) && is_array($output['images'])){
                foreach ($output['images'] as $image) {
                    $createdOutput->addMedia($image)->toMediaCollection();
                }
            }
        }
    }
}
