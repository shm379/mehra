<?php

namespace App\Http\Resources;

use App\Enums\UserCity;
use App\Enums\UserGender;
use App\Enums\UserType;


class UserResource extends MehraResource
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
            'first_name'=> $this->first_name,
            'last_name'=> $this->last_name,
            'name'=> $this->name,
            'country'=> $this->whenLoaded('country'),
            'national_number'=> $this->national_number,
            'email'=> $this->email,
            'email_verified_at'=> $this->email_verified_at ? jdate($this->email_verified_at)->format('Y-m-d') : $this->email_verified_at,
            'mobile'=> $this->mobile,
            'mobile_verified_at'=> $this->mobile_verified_at ? jdate($this->mobile_verified_at)->format('Y-m-d') : $this->mobile_verified_at,
            'type'=> !is_null($this->type) ? UserType::getDescription((int)$this->type) : $this->type,
            'gender'=> !is_null($this->type) ? UserGender::getDescription((int)$this->gender) : $this->gender,
            'city'=> optional($this->city)->title,
            'state'=> optional($this->state)->title,
            'addresses'=> $this->whenLoaded('addresses'),
            'histories'=> $this->whenLoaded('search_histories'),
            'wallet_balance'=> $this->whenLoaded('wallet',function (){
                return $this->wallet->balance;
            }),
            'views'=> $this->whenLoaded('views'),
            'discounts'=> $this->whenLoaded('discounts'),
            'image'=> $this->hasMedia('avatar') ? optional(optional($this->getMedia('avatar'))->first())->original_url : '',
        ];
    }
}
