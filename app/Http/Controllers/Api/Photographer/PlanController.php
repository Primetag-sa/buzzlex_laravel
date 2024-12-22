<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photographer\PlanRequest;
use App\Http\Resources\Photographer\PlanResource;
use App\Http\Resources\SuccessResource;
use App\Services\Photographer\PlanService;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use SebastianBergmann\CodeCoverage\Test\TestStatus\Success;

class PlanController extends Controller
{
    public function store(PlanRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        try{
            \DB::beginTransaction();
            $plan = $user->plans()->create(Arr::only($data, ['name', 'description', 'price', 'is_recommended', 'type']));
            $plan->features()->createMany(Arr::get($data, 'features',[]));
            $plan->conditions()->createMany(Arr::get($data, 'conditions',[]));
            $plan->addons()->createMany(Arr::get($data, 'addons', []));
            (new PlanService)->handleOutputs($plan, Arr::get($data, 'outputs', []), false);
            \DB::commit();
        } catch(Exception $e){
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return new SuccessResource([], 'Plan created successfully');
    }

    public function index()
    {
        $user = auth()->user();
        $plans = $user->plans;
        return PlanResource::collection($plans);
    }

    public function show(Plan $plan)
    {
        return new PlanResource($plan);
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return new SuccessResource([], 'Plan deleted successfully');
    }

    public function update(Plan $plan, PlanRequest $request)
    {
        $data = $request->validated();
        try{
            \DB::beginTransaction();
            $plan->update(Arr::only($data, ['name', 'description', 'price', 'is_recommended', 'type']));
            $plan->features()->delete();
            $plan->features()->createMany(Arr::get($data, 'features',[]));
            $plan->conditions()->delete();
            $plan->conditions()->createMany(Arr::get($data, 'conditions',[]));
            $plan->addons()->delete();
            $plan->addons()->createMany(Arr::get($data, 'addons', []));
            (new PlanService)->handleOutputs($plan, Arr::get($data, 'outputs', []), true);
            \DB::commit();
        } catch(Exception $e){
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return new SuccessResource([], 'Plan updated successfully');
    }
}
