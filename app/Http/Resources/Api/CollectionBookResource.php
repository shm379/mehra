<?php

namespace App\Http\Resources\Api;

use App\Enums\CollectionType;


class CollectionBookResource extends MehraResource
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
            'title'=> $this->title,
            'cover_image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('cover_image'))
                    return $this->getFirstMediaUrl('cover_image');
            }),
            'back_image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('back_image'))
                    return $this->getFirstMediaUrl('back_iamge');
            }),
        ];
    }
}
