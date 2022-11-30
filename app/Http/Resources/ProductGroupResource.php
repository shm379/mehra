<?php

namespace App\Http\Resources;

use App\Enums\ProductGroupType;

class ProductGroupResource extends MehraResource
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
            'products'=> $this->whenLoaded('products', function (){
                return ProductResource::collection($this->products->load([
                    'parent',
                    'volume',
                    'producer',
                    'comments'=>function($comment){
                        $comment->with(['media','user','points','likes'])->where('status',1);
                    },
                    'creators'=>function($creator){
                        $creator->with('types');
                    },
                    'collections',
                    'awards',
                    'groups',
                    'categories',
                    'questions',
                    'attributes'=>function($attribute){
                        $attribute->with('values');
                    },
                    'media'
                ])
                );
            }),
            'name'=> $this->name,
            'price'=> $this->whenLoaded('products',function (){
                return $this->products->sum('price');
            }),
            'sale_price'=> $this->whenLoaded('products',function (){
                return $this->products->sum('sale_price');
            }),
            'type'=> ProductGroupType::getDescription($this->type),
            'is_active'=> $this->is_active
        ];
    }
}
