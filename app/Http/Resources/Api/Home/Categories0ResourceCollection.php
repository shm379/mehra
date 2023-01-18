<?php

namespace App\Http\Resources\Api\Home;

class Categories0ResourceCollection extends HomeResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->first()->parent_id,
            'title'=> $this->first()->parent->title,
            'items' => $this->collection,
        ];
    }
}
