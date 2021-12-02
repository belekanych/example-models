<?php

namespace App\Http\Resources;

class ClientResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->resource->id,
            'name'   => $this->resource->name,
            'orders' => $this->resourceWhenLoaded('orders', OrderResource::class),
        ];
    }
}
