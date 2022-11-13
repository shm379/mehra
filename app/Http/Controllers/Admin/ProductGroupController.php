<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productGroups = ProductGroup::query()->with(['products:title'])->get();
        if(\request()->ajax()){
            foreach ($productGroups as $productGroup) {
                if($productGroup->products){
                    foreach ($productGroup->products as $productKey => $product){
                        $productGroup->products[$productKey] = $product->title;
                    }
                }
            }
            return DataTables::of($productGroups)
                ->editColumn('price',function ($productGroup){
                    return number_format($productGroup->price).' تومان';
                })
                ->editColumn('is_active',function ($productGroup){
                    return $productGroup->is_active==1?'فعال':'غیرفعال';
                })
                ->make();
        }
        return view('admin.product_groups.index', compact('productGroups'));
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
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGroup $productGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGroup $productGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGroup $productGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductGroup  $productGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGroup $productGroup)
    {
        //
    }
}
