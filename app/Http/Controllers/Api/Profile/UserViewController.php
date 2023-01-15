<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\UserViewResourceCollection;
use App\Models\UserWishlist;
use Illuminate\Http\Request;

class UserViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserViewResourceCollection
     */
    public function __invoke()
    {
        $views = auth()->user()->views()->with('model')->paginate($this->perPage);
        return new UserViewResourceCollection($views);
    }
}
