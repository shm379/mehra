<?php

namespace App\Http\Resources;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWishlistResource extends MehraResource
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
            'image'=> $this->whenLoaded('product',function (){
                if($this->product->hasMedia('back_image'))
                    return $this->product->getMedia('back_image')->first()->original_url;
                if($this->product->hasMedia('main_image'))
                    return $this->product->getMedia('main_image')->first()->original_url;
            }),
            'title'=> $this->product->title,
            'main_price'=> Helpers::toman($this->product->price),
            'price'=> $this->product->sale_price ? Helpers::toman($this->product->sale_price) : Helpers::toman($this->product->price),
            'rate'=> 1,
            'discount'=> 10,
            'product_id'=> $this->product_id,
        ];
    }
}
