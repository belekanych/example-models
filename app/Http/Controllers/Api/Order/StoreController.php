<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): OrderResource
    {
        $order = new Order($request->only('name'));
        $order->client()->associate($request->input('clientId'));
        $order->status()->associate($request->input('statusId'));
        $order->save();

        return OrderResource::make($order);
    }
}
