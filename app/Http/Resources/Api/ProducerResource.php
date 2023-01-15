<?php

namespace App\Http\Resources\Api;

use App\Enums\ProducerType;


class ProducerResource extends MehraResource
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
            'sub_title'=> $this->sub_title,
            'slug'=> $this->slug,
            'description'=> $this->description,
            'site_url'=> $this->site_url,
            'type'=> ProducerType::getDescription($this->type),
            'is_active'=> $this->is_active,
            'books'=> $this->whenLoaded('books', function (){
                return BookResource::collection($this->books);
            }),
            'logo'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('logo'))
                    return $this->getFirstMediaUrl('logo');
            }),
        ];
    }
}
