<?php

namespace App\Http\Resources\Admin\Home;

use App\Http\Resources\Api\Home\HomeResource;
use App\Http\Resources\Api\Home\ProductResource;

class ListsResource extends HomeResource
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
            'id'=> $this->id,
            'title'=> $this->title,
            'items'=> ProductResource::collection($this->products()->get())
        ];
    }

}
