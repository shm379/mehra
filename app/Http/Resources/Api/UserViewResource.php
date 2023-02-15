<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class UserViewResource extends MehraResource
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
            'id'=> $this->model->id,
            'title'=> $this->model->title,
            'sub_title'=> $this->model->sub_title,
            'discount'=> $this->model->sale_price,
            'price'=> $this->model->price,
            'currency'=> 'تومان',
            'price_formatted'=> Helpers::toman($this->model->price),
            'qty'=> $this->model->max_purchases_per_user,
            'image'=> $this->whenLoaded('model',function (){
                if($this->model->hasMedia('back_image'))
                    return $this->model->getFirstMediaUrl('back_image');
                if($this->model->hasMedia('image'))
                    return $this->model->getFirstMediaUrl('image');
            }),
        ];
    }
}
