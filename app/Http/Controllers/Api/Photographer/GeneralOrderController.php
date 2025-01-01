<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photographer\ProposalRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\GeneralOrderResource;
use App\Models\GeneralOrder;
use App\Models\Plan;
use Illuminate\Http\Request;

class GeneralOrderController extends Controller
{
    public function index()
    {
        $orders = GeneralOrder::pending()->paginate();
        return GeneralOrderResource::collection($orders);
    }

    public function show(GeneralOrder $generalOrder)
    {
        return new GeneralOrderResource($generalOrder);
    }

    public function sendProposal(ProposalRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $generalOrder = GeneralOrder::find($data['general_order_id']);
        $plan = Plan::find($data['plan_id']);
        $generalOrder->proposals()->create([
            'plan_id' => $plan->id,
            'price' => $data['price'] ?? $plan->price,
            'photographer_id' => $user->id
        ]);
        return new SuccessResource([], 'Proposal sent successfully');
    }
}
