<?php

namespace App\Http\Resources\Api;

use App\Helpers\Helpers;


class CartEmptyResource extends CartResource
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
            'items'=> [],
            'total_items'=> 0,
            'total_price'=> 0,
            'total_price_formatted'=> Helpers::toman(0),
            'currency'=> 'تومان',
            'profit'=> 0,
            'profit_formatted'=> Helpers::toman(0),
            'shipping_price'=> 0,
            'shipping_price_formatted'=> Helpers::toman(0),
            'is_shipping_free'=> false,
            'address'=> UserAddressResource::make([]),
            'user'=> UserResource::make(auth()->user()),
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
