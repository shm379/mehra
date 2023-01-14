<?php

namespace App\Http\Resources\Home;

use App\Enums\ProductStructure;
use App\Helpers\Helpers;
use App\Http\Resources\BookResource;
use App\Http\Resources\MehraResource;
use App\Models\Book;


class SaleResource extends MehraResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ProductResource::make($this);
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
