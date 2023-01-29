<?php

namespace App\Http\Resources\Api;

use App\Enums\CollectionType;
use App\Enums\ProductStructure;
use App\Enums\ProductType;


class CollectionProductResource extends MehraResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'slug'=> $this->slug,
            'type'=> ProductType::getDescription($this->type),
            'title'=> $this->title,
            'image'=> $this->whenLoaded('medias',function (){
                $image = 'main_image';
                if($this->structure) {
                    $image = $this->structure == ProductStructure::BOOK ? 'cover_image' : 'main_image';
                }
                return $this->hasMedia($image) ? $this->getFirstMediaUrl($image) : null;
            }),
        ];
    }
}
