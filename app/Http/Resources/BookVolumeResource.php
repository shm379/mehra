<?php

namespace App\Http\Resources;

use App\Enums\ProductType;
use Illuminate\Http\Resources\Json\JsonResource;

class BookVolumeResource extends BookResource
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
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'active'=> $this->is_active_volume,
        ];
    }
}
