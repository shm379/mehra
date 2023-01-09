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
            'name'=> preg_replace( "/\r|\n/", "", $this->name ),
            'role'=> $this->pivot->creator_creator_type_id->name,
            'icon'=> $this->whenLoaded('media',function (){
                if($this->hasMedia('avatar'))
                    return $this->getMedia('avatar')->first()->original_url;
            }),
        ];
    }
}