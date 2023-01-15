<?php

namespace App\Http\Resources\Api;

class BookVolumeResource extends MehraResource
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
            'title'=> $this->volume->title,
            'active'=> $this->is_active_volume,
        ];
    }
}
