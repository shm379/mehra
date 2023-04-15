<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Models\Book;


class OrderItemResource extends MehraResource
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
            'order_id'=> $this->order_id,
            'product_id'=> $this->line_item_id,
            'title'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->title;
            }),
            'sub_title'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->sub_title;
            }),
            'image'=> $this->whenLoaded('line_item',function (){
                if($this->line_item->hasMedia('image'))
                    return $this->line_item->getFirstMediaUrl('image');
            }),
            'price'=> $this->price,
            'currency'=> 'تومان',
            'price_formatted'=> $this->price,
            'number'=> $this->quantity,
            'total'=> $this->quantity*$this->price,
            'total_formatted'=> Helpers::toman($this->quantity*$this->price),
            'is_auction'=> $this->discount,
        ];
    }
}
