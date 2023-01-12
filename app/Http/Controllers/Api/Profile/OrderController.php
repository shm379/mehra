<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\Controller;
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
    public function __invoke()
    {
        $orders = auth()->user()->orders()->with(['items'=>function($i) {
                $i->with(
                    [
                        'line_item' => function ($line_item) {
                            $line_item->with(['producer']);
                        }
                    ]);
            }]
        )->paginate($this->perPage);;
        return new OrderResourceCollection($orders);
    }
}
