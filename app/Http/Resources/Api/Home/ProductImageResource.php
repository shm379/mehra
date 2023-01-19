<?php

namespace App\Http\Resources\Api\Home;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Http\Resources\Api\MehraResource;
use App\Models\Book;


class ProductImageResource extends MehraResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = 'main_image';
        if($this->structure) {
            $image = $this->structure == ProductStructure::BOOK ? 'cover_image' : 'main_image';
            if ($this->structure == ProductStructure::BOOK) {
                $this->resource = Book::query()->with(['medias'])->find($this->id);
            }
        }
        $media = $this->hasMedia($image) ? $this->getFirstMediaUrl($image) : null;
        return [
            'id'=> $this->id,
            'image'=> $media,
        ];
    }
}
