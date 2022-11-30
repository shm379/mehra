<?php

namespace App\Http\Resources;

use App\Enums\ProducerType;


class ProducerResource extends MehraResource
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
            'sub_title'=> $this->sub_title,
            'slug'=> $this->slug,
            'description'=> $this->description,
            'site_url'=> $this->site_url,
            'producer_type'=> ProducerType::getDescription($this->producer_type),
            'is_active'=> $this->is_active,
        ];
    }
}
