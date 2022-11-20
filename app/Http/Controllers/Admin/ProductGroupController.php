<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProducerType;
use App\Enums\ProductGroupType;
use App\Models\ProductGroup;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ProductGroupController extends Controller
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
                        ->orWhere('title', 'LIKE', "%{$value}%")
                        ->orWhere('sub_title', 'LIKE', "%{$value}%")
                        ->orWhere('slug', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%");
                });
            });
        });
        // get per page number
        $per_page = abs($request->perPage) > 0 ? abs($request->perPage) : 15;
        QueryBuilderRequest::setArrayValueDelimiter('|');
        // get users from query builder
        $productGroups = QueryBuilder::for(ProductGroup::class)
            ->with('products')
            ->withCount('products')
            ->defaultSort('created_at')
            ->allowedSorts([
                'title',
                'description',
                'price',
                'sub_title',
                'sku',
                'comments_count',
                'created_at',
            ])
            ->allowedIncludes(['comments'])
            ->allowedFilters([
                'comments_count',
                'title',
                'price',
                $globalSearch])
            ->paginate($per_page)
            ->through(function ($productGroup) {
                return [
                    'id'=> $productGroup->id,
                    'name'=> $productGroup->name,
                    'price'=> $productGroup->price,
                    'sale_price'=> $productGroup->sale_price,
                    'type'=> ProductGroupType::getDescription($productGroup->type),
                    'is_acitve'=> $productGroup->is_acitve,
                ];
            })
            ->withQueryString();
        // return table in inertia with columns
        return Inertia::render('ProductGroup/Index')
            ->with(['productGroups' => $productGroups]);
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
