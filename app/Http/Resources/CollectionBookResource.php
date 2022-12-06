<?php

namespace App\Http\Resources;

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
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'cover_image'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('cover_image'))
                    return $this->getMedia('cover_image')->first()->original_url;
            }),
            'back_image'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('back_image'))
                    return $this->getMedia('back_image')->first()->original_url;
            }),
        ];
    }
}