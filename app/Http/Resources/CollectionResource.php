<?php

namespace App\Http\Resources;

use App\Enums\CollectionType;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
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
            'title'=> $this->title,
            'slug'=> $this->slug,
            'description'=> $this->description,
            'type'=> CollectionType::getDescription($this->type),
            'is_private'=> $this->is_private,
            'user'=> $this->whenLoaded('user',function (){
//                return
            })
        ];
    }
}
