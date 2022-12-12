<?php

namespace App\Http\Resources;

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
                return preg_replace( "/\r|\n/", "", $this->line_item->title);
            }),
            'sub_title'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->sub_title;
            }),
            'price'=> Helpers::toman($this->price),
            'number'=> $this->quantity,
            'total'=> Helpers::toman($this->quantity*$this->price),
            'is_auction'=> $this->discount,
        ];
    }
}
