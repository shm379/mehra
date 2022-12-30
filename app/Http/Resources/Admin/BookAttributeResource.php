<?php

namespace App\Http\Resources\Admin;

use App\Enums\AttributeType;
use App\Enums\ProductType;
use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;


class BookAttributeResource extends JsonResource
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
            'parent_id'=> $this->parent_id,
            'children'=> $this->whenLoaded('children'),
            'title'=> preg_replace( "/\r|\n/", "", $this->name ),
            'slug'=> $this->slug,
            'type'=> $this->type,
            'url'=> route('admin.autocomplete.attributes.show',$this->id).'/',
            'values'=> new BookAttributeValueSelectResourceCollection($this->values),
            'icon'=> $this->icon,
        ];
    }
}
