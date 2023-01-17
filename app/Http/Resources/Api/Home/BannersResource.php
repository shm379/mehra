<?php

namespace App\Http\Resources\Api\Home;

use App\Enums\AnnouncementPosition;


class BannersResource extends HomeResource
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
            'url'=> $this->url,
            '_blank'=> (bool)$this->_blank,
            'image'=> $this->whenLoaded('image',function (){
                if($this->hasMedia('image'))
                    return $this->getFirstMediaUrl('image');
            }),
        ];
    }

    public function __construct($resource)
    {
        if($resource->position==AnnouncementPosition::EVERYWHERE || $resource->position==AnnouncementPosition::HOME)
           parent::__construct($resource);

    }
}
