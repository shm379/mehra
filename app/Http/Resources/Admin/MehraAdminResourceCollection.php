<?php

namespace App\Http\Resources\Admin;

use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class MehraAdminResourceCollection extends ResourceCollection
{
    public static $wrap = null;
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
