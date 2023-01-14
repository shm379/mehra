<?php

namespace App\Http\Resources\Home;

use App\Helpers\Helpers;
use App\Http\Resources\MehraResource;


class ProductResource extends MehraResource
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
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('main_image'))
                    return $this->getFirstMediaUrl('main_image');
            })
        ];
    }


    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => true
        ];
    }
}
