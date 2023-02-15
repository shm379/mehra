<?php

namespace App\Http\Resources\Admin;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;


class OrderItemResource extends JsonResource
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
            'is_virtual'=> $this->is_virtual,
            'discount_applied'=> $this->discount_applied,
            'line_item_id'=> $this->line_item_id,
            'line_item_type'=> $this->line_item_type,
            'structure'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->structure;
            }),
            'title'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->title;
            }),
            'sub_title'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->sub_title;
            }),
            'producer'=> $this->whenLoaded('line_item',function (){
                return $this->line_item->producer;
            }),
            'price'=> Helpers::toman($this->price),
            'quantity'=> $this->quantity,
            'price_without_discount'=> Helpers::toman($this->price_without_discount),
            'total_price_without_discount'=> Helpers::toman($this->total_price_without_discount),
            'total'=> Helpers::toman($this->total_price),
            'is_auction'=> $this->discount_applied,
            'image'=> $this->whenLoaded('line_item',function (){
                if($this->line_item->hasMedia('back_image'))
                    return $this->line_item->getFirstMediaUrl('back_image');
                if($this->line_item->hasMedia('image'))
                    return $this->line_item->getFirstMediaUrl('image');
            }),
        ];
    }
}
