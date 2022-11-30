<?php

namespace App\Http\Resources;

use App\Enums\ProductType;
use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class BookGalleryResource extends JsonResource
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
            'url'=> $this->original_url,
            'type'=> $this->mime_type
        ];
    }
}
