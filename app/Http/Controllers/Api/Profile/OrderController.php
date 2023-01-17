<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\OrderResourceCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderResourceCollection
     */
    public function __invoke()
    {
        $orders = auth()->user()->orders();
        $orders = $orders->with(['items'=>function($i) {
                $i->with([
                        'line_item' => function ($line_item) {
                            $line_item->with(['producer','medias']);
                        }
                    ]);
            }
        ]);

        if(\request()->has('status')){
            $orders = $orders->where('status',\request()->get('status'));
        }
        $orders = $orders->paginate($this->perPage);

        return new OrderResourceCollection($orders);
    }
}
