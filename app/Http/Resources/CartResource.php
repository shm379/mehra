<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'items'=> $this->items,
            'total_items'=> count($this->items),
            'total_price'=> $this->total_price,
            'shipping_price'=> 0,
            'is_shipping_free'=> true
        ];
    }
}
