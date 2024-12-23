<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $orders = Order::filter($request->only([
            'status',
            'date',
            'type'
        ]))
                    ->where('photographer_id', $user->id)
                    ->paginate();

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        $order->load('plan', 'addons');
        return new OrderResource($order);
    }
}
