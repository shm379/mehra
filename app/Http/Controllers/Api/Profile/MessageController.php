<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->messages;
        dd($notifications);
        return new NotificationResourceCollection($notifications);
    }
}
