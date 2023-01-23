<?php

namespace App\Http\Resources\Api\Search;

use App\Http\Resources\Api\MehraResource;

class SearchCreatorResource extends MehraResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge([
            'id'=> $this->id,
            'title'=> $this->title,
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('cover_image'))
                    return $this->getFirstMediaUrl('cover_image');
                if($this->hasMedia('main_image'))
                    return $this->getFirstMediaUrl('main_image');
            }),
        ]);
    }
}
