<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(Order $order, StoreRequest $request): OrderResource
    {
        $order->fill($request->validated());
        $order->client()->associate($request->input('clientId'));
        $order->status()->associate($request->input('statusId'));
        $order->save();

        return OrderResource::make($order);
    }
}
