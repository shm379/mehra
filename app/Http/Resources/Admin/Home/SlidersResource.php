<?php

namespace App\Http\Resources\Admin\Home;

use  App\Helpers\Helpers;
use App\Http\Resources\Api\MehraResource;


class SlidersResource extends MehraResource
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
            'link'=> $this->link,
            'color'=> $this->color,
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('main_image'))
                    return $this->getFirstMediaUrl('main_image');
            })
        ];
    }

}
