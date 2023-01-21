<?php

namespace App\Http\Resources\Api\Home;

class Collections3Resource extends HomeResource
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
            'items'=> ProductImageResource::collection($this->products()->get())
        ];
    }


}
