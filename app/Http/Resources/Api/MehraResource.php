<?php

namespace App\Http\Resources\Api;

use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;


class MehraResource extends JsonResource
{
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

    public function getDefaultAvatar()
    {
        return url('/img/avatar.png');
    }
}
