<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\NotificationResourceCollection;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->messages()->paginate($this->perPage);
        return new NotificationResourceCollection($notifications);
    }
    public function store(Notification $message)
    {
        $message->update([
            'read_at'=>now()
        ]);
        return $this->successResponse('با موفقیت انجام شد');
    }
}
