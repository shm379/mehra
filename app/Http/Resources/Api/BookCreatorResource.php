<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductType;
use App\Helpers\Helpers;


class BookCreatorResource extends MehraResource
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
            'name'=> $this->name,
            'role'=> $this->pivot->creator_creator_type_id->name,
            'icon'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('avatar'))
                    return $this->getFirstMediaUrl('avatar');
            }),
        ];
    }
}
