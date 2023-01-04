<?php

namespace App\Http\Resources\Admin;

use App\Enums\ProductType;
use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ProductGroupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    protected function getData(): array
    {
        return [
            'id'=> $this->id,
            'sku'=> $this->sku,
            'related'=> $this->whenLoaded('related'),
            'upsell'=> $this->whenLoaded('upsell'),
            'cross_sell'=> $this->whenLoaded('cross_sell'),
            'parent'=> $this->whenLoaded('parent'),
            'slug'=> $this->slug,
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'sub_title'=> $this->sub_title,
            'structure'=> $this->structure,
            'type'=> $this->type,
            'attributes'=> $this->attributeValues->groupBy('attribute_id'),
            'description'=> $this->description,
            'main_price'=> $this->price,
            'price'=> $this->sale_price ? $this->sale_price : $this->price,
            'sale_percent'=> $this->sale_price==0 && !isset($this->sale_price) ? 0 : (1 - ($this->price / $this->sale_price)) * 100,
            'main_price_formatted'=> Helpers::toman($this->price),
            'price_formatted'=> $this->sale_price ? Helpers::toman($this->sale_price) : Helpers::toman($this->price),
            'vat'=> $this->vat,
        ];
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge($this->getData(),[]);
    }
}
