<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorResource extends JsonResource
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
            'title'=> $this->title,
            'slug'=> $this->slug,
            'first_name'=> $this->first_name,
            'last_name'=> $this->last_name,
            'name'=> $this->name,
            'description'=> $this->description,
            'birthday'=> $this->birthday,
            'nickname'=> $this->nickname,
        ];
    }
}
