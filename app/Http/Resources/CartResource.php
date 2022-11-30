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
    public function toArray($items)
    {
        return [
            'items'=> $this->items,
            'total_items'=> count($this->items),
            'total_price'=>0,
            'post_price'=> 0
        ];
    }
}
