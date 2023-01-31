<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AwardType;
use App\Enums\OrderStatus;
use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Award;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        // global input search
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                \Illuminate\Database\Eloquent\Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhereRaw("concat(first_name, ' ', last_name) like '%$value%' ")
                        ->orWhere('title', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%");
                });
            });
        });
        // get per page number
        $per_page = abs($request->perPage) > 0 ? abs($request->perPage) : 15;
        QueryBuilderRequest::setArrayValueDelimiter('|');
        // get users from query builder
        $orders = QueryBuilder::for(Order::class)
            ->defaultSort('created_at')
            ->allowedSorts([
            ])
            ->allowedIncludes([
            ])
            ->allowedFilters([
                $globalSearch])
            ->paginate($per_page)
            ->through(function ($order) {
                return [
                    'id' => $order->id,
                    'discount' => !is_null($order->discount) ? optional($order->discount)->title : 'بدون تخفیف',
                    'total_price_without_discount' => number_format($order->total_price_without_discount) . ' تومان',
                    'total_final_price' => number_format($order->total_final_price) . ' تومان',
                    'status' => OrderStatus::getDescription((int)$order->status),
                    'items' => count($order->items) ? implode('<br>',Product::query()->with('medias')->whereIn('id',$order->items->where('line_item_type','product')->pluck('line_item_id')->toArray())->pluck('title')->toArray()) : '',
                    'notes' => count($order->notes) ? implode('<br>',optional($order->notes)->pluck('note')->toArray()) : '',
                ];
            })
            ->withQueryString();
        // return table in inertia with columns
        return Inertia::render('Order/Index')
            ->with(['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderStatuses = OrderStatus::asSelectArray();
        return Inertia::render('Order/Show')
            ->with(['order'=>OrderResource::make($order),'order_status'=>$orderStatuses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if($request->has('status')){
            $order->update(['status' => $request->get('status')]);
        }
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
