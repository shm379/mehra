<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Models\Book;
use App\Models\Product;
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
        $wishListArray = [
            'image'=> $this->whenLoaded('model',function (){
                if($this->model->hasMedia('back_image'))
                    return $this->model->getFirstMediaUrl('back_image');
                if($this->model->hasMedia('main_image'))
                    return $this->model->getFirstMediaUrl('main_image');
            }),
            'title'=> $this->model->title,
            'id'=> $this->model_id,
        ];
        if(Helpers::isProduct($this->model)){
            $wishListArray['main_price'] = $this->model->price;
            $wishListArray['main_price_formatted'] = $this->model->price;
            $wishListArray['currency'] = 'تومان';
            $wishListArray['price'] = $this->model->sale_price ? Helpers::toman($this->model->sale_price) : Helpers::toman($this->model->price);
            $wishListArray['rate'] = 1;
            $wishListArray['discount'] = 10;
        }
        return $wishListArray;
    }
}
