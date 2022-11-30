<?php

namespace App\Http\Resources;

use App\Enums\ProductType;


class BookVolumeResource extends MehraResource
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
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'active'=> $this->is_active_volume,
        ];
    }
}
