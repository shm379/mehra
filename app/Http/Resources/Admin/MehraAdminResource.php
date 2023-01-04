<?php

namespace App\Http\Resources\Admin;

use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;


class MehraAdminResource extends JsonResource
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

    public function getDefaultAvatar()
    {
        return url('/img/avatar.png');
    }
}
