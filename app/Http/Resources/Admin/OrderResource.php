<?php

namespace App\Http\Resources\Admin;

use App\Helpers\Helpers;
use App\Http\Resources\UserAddressResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;


class OrderResource extends JsonResource
{

    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'date'=> $this->date,
            'address_id'=> $this->address_id,
            'total_items'=> count($this->items) ? $this->items->sum('quantity') : 0,
            'total_price'=> Helpers::toman($this->total_price),
            'total_price_without_discount'=> Helpers::toman($this->total_price_without_discount),
            'shipping_price'=> 0,
            'is_shipping_free'=> true,
            'items'=> $this->whenLoaded('items',function (){
                return OrderItemResource::collection($this->items);
            }),
            'user'=> $this->whenLoaded('user',function (){
                return UserResource::make($this->user);
            }),
            'address'=> $this->whenLoaded('address',function (){
                return $this->address;
            }),
            'notes'=> $this->whenLoaded('notes',function (){
                return new OrderNoteResourceCollection($this->notes);
            }),
            'status'=> $this->status,
        ];
    }

}
