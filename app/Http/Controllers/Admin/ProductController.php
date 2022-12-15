<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProducerType;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $products = QueryBuilder::for(Product::class)
            ->with('producer')
            ->withCount('comments')
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
            ->through(function ($product) {
                return [
                    'id'=> $product->id,
                    'sku'=> $product->sku,
                    'related'=> $product->related,
                    'upsell'=> $product->upsell,
                    'cross_sell'=> $product->cross_sell,
                    'parent'=> $product->parent,
                    'volume'=> $product->volume,
                    'volume_title'=> isset($product->order_volume) ? 'جلد '.$product->order_volume : null,
                    'volumes'=> $product->volumes,
                    'title'=> preg_replace( "/\r|\n/", "", $product->title ),
                    'slug'=> $product->slug,
                    'sub_title'=> $product->sub_title,
                    'description'=> $product->description,
                    'excerpt'=> $product->excerpt,
                    'summary'=> $product->summary,
                    'pdf'=> $product->pdf,
                    'opinions'=> $product->opinions,
                    'price'=> $product->price,
                    'sale_price'=> $product->sale_price,
                    'vat'=> $product->vat,
                    'producer'=> $product->producer,
                    'order'=> $product->order,
                    'order_volume'=> $product->order_volume,
                    'product_type'=> isset($product->product_type) ? ProducerType::getDescription($product->product_type) : null,
                    'min_purchases_per_user'=> $product->min_purchases_per_user,
                    'max_purchases_per_user'=> $product->max_purchases_per_user,
                    'is_available'=> $product->is_available,
                    'in_stock_count'=> $product->in_stock_count,
                    'is_active'=> $product->is_active,
                    'is_active_volume'=> $product->is_active_volume,
                    'ranks'=> $product->rank_attributes,
                    'rank'=> $product->rank,
                    'comments'=> $product->comments->load(['points','likes']),
                    'creators'=> $product->creators,
                    'main_image'=> $product->hasMedia('main_image') ? $product->getMedia('main_image')->first()->original_url : '',
                    'gallery'=> $product->hasMedia('gallery') ? $product->getMedia('gallery') : '',
                    'collections'=> $product->collections,
                    'categories'=> $product->categories,
                    'questions'=> $product->questions,
                    'attributeValues'=> $product->attributeValues,
                    'awards'=> $product->awards,
                    'groups'=> $product->groups
                ];
            })
            ->withQueryString();
        dd($products->first());
        // return table in inertia with columns
        return Inertia::render('Product/Index')
            ->with(['products' => $products])
            ->table(function (InertiaTable $table) {
                $table
                    ->withGlobalSearch('جستجو در لیست محصولات ...')
                    ->defaultSort('created_at')
                    ->column(key: 'title', label: 'عنوان', canBeHidden: false, sortable: true, searchable: true)
                    ->column(key: 'sub_title', label: 'زیر عنوان', sortable: true, searchable: true)
                    ->column(key: 'description', label: 'توضیحات', sortable: true, searchable: true)
                    ->column(key: 'price', label: 'قیمت', sortable: true, searchable: true)
                    ->column(key: 'comments_count', label: 'تعداد دیدگاه ها', sortable: true, searchable: true)
                    ->column(key:'actions', label: 'عملیات')
                    ->selectFilter(
                        key: 'price',
                        options: [
                        '1000' => '1000',
                        '2000' => '2000',
                    ],
                        label: 'قیمت    ');
            });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create');
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
