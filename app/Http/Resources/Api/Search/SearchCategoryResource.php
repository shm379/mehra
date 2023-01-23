<?php

namespace App\Http\Resources\Api\Search;

use App\Http\Resources\Api\MehraResource;

class SearchCategoryResource extends MehraResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge([
            'id'=> $this->id,
            'title'=> $this->title,
        ]);
    }
}
