<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResourceCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderResourceCollection
     */
    public function index()
    {
        $orders = Order::query()->with(['items'])->get();
        return new OrderResourceCollection($orders);
    }
}
