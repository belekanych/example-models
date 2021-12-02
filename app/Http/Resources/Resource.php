<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class Resource extends JsonResource
{
    protected function resourceWhenLoaded(string $relation, string $resource)
    {
        if (!$this->resource->relationLoaded($relation)) {
            return null;
        }

        if ($this->resource->$relation instanceof Collection) {
            return $resource::collection($this->resource->$relation);
        }

        return $resource::make($this->resource->$relation);
    }
}
