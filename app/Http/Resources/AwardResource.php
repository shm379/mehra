<?php

namespace App\Http\Resources;

use App\Enums\AwardType;


class AwardResource extends MehraResource
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
            'slug'=> $this->slug,
            'image'=> $this->whenLoaded('medias', function (){
                if($this->hasMedia('image'))
                    return $this->getFirstMediaUrl('image');
            }),
            'cover_image'=> $this->whenLoaded('medias', function (){
                if($this->hasMedia('cover_image'))
                    return $this->getFirstMediaUrl('cover_image');
            }),
            'type'=> AwardType::getDescription($this->type),
            'description'=> $this->description,
        ];
    }
}
