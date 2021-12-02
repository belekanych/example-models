<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\OrderResource;
use App\Models\Client;
use App\Models\Order;

class IndexController extends Controller
{
    public function __invoke()
    {
        return ClientResource::collection(
            Client::all()
        );
    }
}
