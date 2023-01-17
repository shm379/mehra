<?php

namespace App\Http\Resources\Api;

use App\Helpers\Helpers;


class CartResource extends MehraResource
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
            'items'=> $this->whenLoaded('items',function (){
                return new CartItemResourceCollection($this->items->load(['line_item'=>function($line_item) {
                    $line_item->with(['producer', 'medias']);
                    }]
                ));
            }),
            'total_items'=> $this->items && count($this->items) ? $this->items->sum('quantity') : 0,
            'total_price'=> $this->total_price,
            'total_price_formatted'=> Helpers::toman($this->total_price),
            'currency'=> 'تومان',
            'profit'=> $this->profit,
            'profit_formatted'=> Helpers::toman($this->profit),
            'shipping_price'=> $this->shipping_price,
            'shipping_price_formatted'=> Helpers::toman($this->shipping_price),
            'is_shipping_free'=> false,
            'address'=> $this->whenLoaded('address',function (){
                return UserAddressResource::make($this->address);
            }),
            'address_id'=> $this->address_id,
            'user'=> $this->whenLoaded('user',function (){
                return UserResource::make($this->user);
            })
        ];
    }


    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => true
        ];
    }
}
