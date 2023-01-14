<?php

namespace App\Http\Resources\Home;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Http\Resources\MehraResource;
use App\Models\Book;


class ProductResource extends MehraResource
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
            'title'=> preg_replace( "/\r|\n/", "", $this->title ),
            'sub_title'=> $this->sub_title,
            'image'=> $media,
        ];
    }


    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => true
        ];
    }
}
