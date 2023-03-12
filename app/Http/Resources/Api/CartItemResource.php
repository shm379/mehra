<?php

namespace App\Http\Resources\Api;

use App\Enums\ProductStructure;
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
//            'order_id'=> $this->order_id,
            'product_id'=> $this->line_item_id,
            'title'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->title;
            }),
            'sub_title'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->sub_title;
            }),
            'image'=> $this->whenLoaded('line_item.medias',function (){
                if($this->line_item->hasMedia('image'))
                    return $this->line_item->getFirstMediaUrl('image');
            }),
            'producer'=> $this->whenLoaded('line_item.producer',function (){
                return ProducerResource::make($this->line_item->producer);
            }),
            'structure'=> $this->whenLoaded('line_item',function (){
                return ProductStructure::getDescription((int)$this->line_item->structure);
            }),
            'price'=> $this->price,
            'price_formatted'=> Helpers::toman($this->price),
            'total_price'=> $this->total_final_price,
            'total_price_formatted'=> Helpers::toman($this->total_final_price),
            'discount'=> $this->discount_amount,
            'total_discount'=> $this->total_discount_amount,
            'remained_qty'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->max_purchases_per_user;
            }),
            'status'=> $this->whenLoaded('line_item', function (){
                return $this->line_item->in_stock_count>0;
            }),
            'number'=> $this->quantity,
            'deleted'=> !is_null($this->deleted_at)
        ];
    }
}
