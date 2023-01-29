<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductStructure;
use App\Http\Resources\Api\Home\ProductResourceCollection;


class CollectionCategoryProductResource extends MehraResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->pivot->collection->id,
            'title'=> $this->pivot->collection->title,
            'items'=> $this->whenLoaded('products',function (){
                return new ProductResourceCollection($this->products->take(4));
            })
        ];
    }
}
