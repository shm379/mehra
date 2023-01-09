<?php

namespace App\Http\Resources\Admin;

use App\Enums\ProductType;
use App\Enums\ProductRelatedType;
use App\Helpers\Helpers;
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
        $file = explode('.', $this->resource);
        $directory = explode('/',$file[array_key_last($file)-1]);
        return [
          'src'=> $this->resource,
          'name'=> end($directory),
          'directory'=> $directory,
          'ext'=> end($file)
        ];
    }
}
