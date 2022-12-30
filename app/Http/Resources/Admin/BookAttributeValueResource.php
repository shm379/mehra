<?php

namespace App\Http\Resources\Admin;

use App\Enums\AttributeType;
use App\Enums\ProductType;
use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;


class BookAttributeValueResource extends JsonResource
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
            'title'=>$this->value,
            'id'=>$this->id,
        ];
    }
}
