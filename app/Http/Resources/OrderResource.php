<?php

namespace App\Http\Resources;

class OrderResource extends Resource
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
            'client' => $this->resourceWhenLoaded('client', ClientResource::class),
            'status' => $this->resourceWhenLoaded('status', OrderStatusResource::class),
        ];
    }
}
