<?php

namespace App\Http\Resources\Admin;

use App\Enums\AttributeType;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductAttributeResource extends JsonResource
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
            'type'=> AttributeType::fromValue((int)$this->type)->key,
            'url'=> route('admin.autocomplete.attributes.show',$this->id).'/',
            'icon'=> $this->icon,
            'values'=> $this->type == AttributeType::SINGLE_CHOICE ? $this->whenLoaded('values',function (){
                return new ProductAttributeValueSelectResourceCollection($this->values);
            }) : [],
        ];
    }
}
