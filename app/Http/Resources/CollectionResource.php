<?php

namespace App\Http\Resources;

use App\Enums\CollectionType;


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
            'books'=> BookResource::collection($this->books),
            'title'=> $this->title,
            'count'=> isset($this->books) ? count($this->books) : 0,
            'image'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('image'))
                    return $this->getMedia('image')->first()->original_url;
            }),
        ];
    }
}
