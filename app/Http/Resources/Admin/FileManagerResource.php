<?php

namespace App\Http\Resources\Admin;

use App\Enums\ProductType;
use App\Enums\ProductRelatedType;
use App\Helpers\Helpers;
use App\Services\Media\Media;
use Illuminate\Http\Resources\Json\JsonResource;

class FileManagerResource extends MehraAdminResource
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
          'url'=> $this->resource->original_url,
          'name'=> $this->resource->name,
          'size'=> $this->resource->humanReadableSize,
          'type'=> $this->resource->type,
          'ext'=> $this->resource->extension
        ];
    }
}
