<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;


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
                return $this->line_item->load('mediaModel');
                return optional($this->line_item->getMedia('main_image')->first())->original_url;
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
