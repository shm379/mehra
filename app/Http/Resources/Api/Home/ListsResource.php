<?php

namespace App\Http\Resources\Api\Home;

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
