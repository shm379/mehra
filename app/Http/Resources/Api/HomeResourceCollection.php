<?php

namespace App\Http\Resources\Api;

class HomeResourceCollection extends MehraResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [];
        }
        return $this->collection->map->toArray($request)->all();
    }
}
