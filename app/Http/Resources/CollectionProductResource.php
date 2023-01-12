<?php

namespace App\Http\Resources;

use App\Enums\CollectionType;


class CollectionProductResource extends MehraResource
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
            'id'=> $this->id,
            'slug'=> $this->slug,
            'type'=> $this->item_type,
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'main_image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('main_image'))
                    return $this->getFirstMediaUrl('main_image');
            }),
        ];
    }
}
