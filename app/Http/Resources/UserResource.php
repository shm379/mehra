<?php

namespace App\Http\Resources;

use App\Enums\UserCity;
use App\Enums\UserGender;
use App\Enums\UserType;
use App\Helpers\Helpers;


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
            'gender'=> !is_null($this->gender) ? UserGender::getDescription((int)$this->gender) : $this->gender,
            'city'=> optional($this->city)->title,
            'state'=> optional($this->state)->title,
            'addresses'=> $this->whenLoaded('addresses'),
            'histories'=> $this->whenLoaded('search_histories'),
            'wallet_balance'=> !is_null($this->wallet) ? Helpers::toman($this->wallet->balance) : Helpers::toman(0),
            'views'=> $this->whenLoaded('views'),
            'discounts'=> $this->whenLoaded('discounts'),
            'followers'=> $this->whenLoaded('follows',function (){
                return $this->followers()->get();
            }),
            'followers_count'=> $this->followers()->count(),
            'following'=> $this->whenLoaded('follows',function (){
                return $this->following()->get();
            }),
            'following_count'=> $this->following()->count(),
            'image'=> $this->hasMedia('avatar') ? optional(optional($this->getMedia('avatar'))->first())->original_url : $this->getDefaultAvatar(),
        ];
    }
}
