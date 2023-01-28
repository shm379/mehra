<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductRelatedType;
use App\Helpers\Helpers;

class ProductFilterAttributeResource extends MehraResource
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
            'title'=> $this->value,
        ];
    }
}
