<?php

namespace App\Http\Resources;

use App\Enums\ProductType;


class BookAttributeResource extends BookResource
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
            'title'=> preg_replace( "/\r|\n/", "", $this->attribute->name ),
            'value'=> preg_replace( "/\r|\n/", "", $this->value ),
            'icon'=> $this->attribute->icon,
        ];
    }
}
