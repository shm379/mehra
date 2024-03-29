<?php

namespace App\Http\Resources\Admin;

use App\Enums\ProductType;
use App\Helpers\Helpers;


class BookCreatorResource extends MehraAdminResource
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
            'name'=> $this->name,
            'role'=> $this->pivot->creator_creator_type_id->name,
            'icon'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('avatar'))
                    return $this->getFirstMediaUrl('avatar');
            }),
        ];
    }
}
