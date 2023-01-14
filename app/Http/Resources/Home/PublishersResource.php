<?php

namespace App\Http\Resources\Home;

use App\Helpers\Helpers;
use App\Http\Resources\MehraResource;


class PublishersResource extends MehraResource
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
            'id'=> $this->id,
            'title'=> $this->title,
            'image'=> $this->hasMedia('logo') ? $this->getFirstMediaUrl('logo') : null,
//            'items'=> ProductResource::collection($this->products()->get()),
        ];
    }

}
