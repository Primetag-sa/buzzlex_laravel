<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GeneralOrderRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\GeneralOrderResource;
use App\Models\GeneralOrder;
use Illuminate\Http\Request;

class GeneralOrderController extends Controller
{
    public function store(GeneralOrderRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $user->generalOrders()->create($data);
        return new SuccessResource(200, 'Order created successfully');
    }

    public function index()
    {
        $user = auth()->user();
        $orders = $user->generalOrders()->withCount('proposals')->paginate();
        return GeneralOrderResource::collection($orders);
    }

    public function show(GeneralOrder $generalOrder)
    {
        $generalOrder->load('proposals');
        return new GeneralOrderResource($generalOrder);
    }

    public function destroy(GeneralOrder $order)
    {
        $order->delete();
        return new SuccessResource([], 'Order deleted successfully');
    }
}
