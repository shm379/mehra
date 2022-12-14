<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\NotificationResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageController extends Controller
{
    public function __invoke()
    {
        $notifications = auth()->user()->messages()->paginate($this->perPage);
        return new NotificationResourceCollection($notifications);
    }
}
