<?php

namespace App\Http\Resources\Admin;

class BookVolumeResource extends MehraAdminResource
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
