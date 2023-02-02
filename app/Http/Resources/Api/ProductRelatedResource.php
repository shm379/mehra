<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductRelatedType;
use App\Helpers\Helpers;

class ProductRelatedResource extends MehraResource
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
            'slug'=> $this->slug,
            'title'=> $this->title,
            'sub_title'=> $this->sub_title,
            'description'=> $this->description,
            'main_price'=> $this->price,
            'price'=> $this->sale_price ?: $this->price,
            'sale_percent'=> $this->sale_percent,
            'main_price_formatted'=> Helpers::toman($this->price),
            'price_formatted'=> $this->sale_price ? Helpers::toman($this->sale_price) : Helpers::toman($this->price),
            'currency'=> 'تومان',
            'max_number'=> $this->max_purchases_per_user,
            'is_liked'=> $this->is_liked,
            'image'=> $this->whenLoaded('medias',function (){
                if($this->hasMedia('تصویرشاخص'))
                    return $this->getFirstMediaUrl('تصویرشاخص');
            }),

        ];
    }
}
