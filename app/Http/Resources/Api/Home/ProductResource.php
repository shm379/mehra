<?php

namespace App\Http\Resources\Api\Home;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Http\Resources\Api\MehraResource;
use App\Models\Book;


class ProductResource extends MehraResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = 'image';
        $media = $this->hasMedia($image) ? $this->getFirstMediaUrl($image) : null;
        return [
            'id'=> $this->id,
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'sub_title'=> $this->sub_title,
            'main_price'=> $this->price,
            'price'=> $this->sale_price ?: $this->price,
//            'sale_percent'=> $this->sale_price==0 && !isset($this->sale_price) ? 0 : (1 - ($this->price / $this->sale_price)) * 100,
            'main_price_formatted'=> Helpers::toman($this->price),
            'price_formatted'=> $this->sale_price ? Helpers::toman($this->sale_price) : Helpers::toman($this->price),
            'currency'=> 'تومان',
            'image'=> $this->hasMedia($image) ? $this->getFirstMediaUrl($image) : null,
        ];
    }
}
