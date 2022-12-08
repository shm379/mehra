<?php

namespace App\Http\Resources;

use App\Helpers\Helpers;


class CartItemResource extends MehraResource
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
            'image'=> $this->whenLoaded('line_item',function (){
                if($this->line_item->hasMedia('back_image'))
                    return optional($this->line_item->getMedia('back_image')->first())->original_url;
            }),
            'producer'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->producer;
            }),
            'price'=> $this->price,
            'discount'=> $this->discount,
            'remained_qty'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->max_purchases_per_user;
            }),
            'status'=> $this->whenLoaded('line_item', function (){
                return $this->line_item->in_stock_count>0;
            }),
            'number'=> $this->quantity,
        ];
    }
}
