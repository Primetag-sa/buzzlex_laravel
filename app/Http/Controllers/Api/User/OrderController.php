<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\OrderResource;
use App\Models\Order;
use App\Models\OrderAddon;
use App\Models\Plan;
use App\Models\PlanAddon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $orders = Order::filter($request->only([
            'status',
            'date',
            'type',
        ]))
                    ->where('user_id', $user->id)
                    ->paginate();

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function store(OrderRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $addons = PlanAddon::whereIn('id', $data['addons'])->get();
        $plan = Plan::find($data['plan_id']);
        $addonsPrice = $addons->sum('price');
        $totalPrice = $plan->price + $addonsPrice;
        $order = Order::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'photographer_id' => $data['photographer_id'],
            'type' => $data['type'],
            'name' => $data['name'],
            'date' => $data['date'],
            'status' => Order::DEFAULT_STATUS,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'total_price' => $totalPrice,
        ]);

        foreach ($addons as $addon) {
            OrderAddon::create([
                'order_id' => $order->id,
                'addon_id' => $addon->id,
                'price' => $addon->price,
            ]);
        }

        // TODO::implement payment link with payment gateway according to percentage_to_pay input

        return new SuccessResource([
            'payment_link' => ""
        ], 'Order created successfully');
    }
}
