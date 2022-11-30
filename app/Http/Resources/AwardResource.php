<?php

namespace App\Http\Resources;

use App\Enums\AwardType;


class AwardResource extends MehraResource
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
            'parent'=> $this->whenLoaded('parent'),
            'slug'=> $this->slug,
            'award_type'=> AwardType::getDescription($this->award_type),
        ];
    }
}
