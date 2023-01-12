<?php

namespace App\Http\Resources;

use App\Enums\CollectionType;
use App\Enums\ProductStructure;


class CollectionResource extends MehraResource
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
            'products'=> CollectionBookResource::collection($this->products),
            'books'=> CollectionBookResource::collection($this->products->where('structure',ProductStructure::BOOK)),
            'title'=> $this->title,
            'count'=> isset($this->products) ? count($this->products) : 0,
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('image'))
                    return $this->getFirstMediaUrl('image');
            }),
        ];
    }
}
