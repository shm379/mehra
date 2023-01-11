<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttributeType;
use App\Enums\ProducerType;
use App\Enums\ProductStructure;
use App\Enums\ProductType;
use App\Helpers\Helpers;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Resources\Admin\ProductAttributeResourceCollection;
use App\Http\Resources\Admin\BookResource;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Attribute;
use App\Models\Book;
use App\Models\Product;
use App\Services\Admin\AdminForm;
use App\Services\Admin\Forms\ProductForm;
use App\Traits\AdminResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ProductController extends Controller
{
    /*
     * Admin Form Service Inject
     */
    protected AdminForm $form;
    public function __construct(ProductForm $form)
    {
        $this->form = $form;
    }

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
                    'title'=> preg_replace( "/\r|\n/", "", $product->title ),
                    'sub_title'=> $product->sub_title,
                    'price'=> Helpers::toman($product->price),
                    'comments_count'=> $product->comments_count,
                ];
            })
            ->withQueryString();
        // return table in inertia with columns
        return Inertia::render('Product/Index')
            ->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formData = $this->form->createMode()->getForm();

        return Inertia::render('Product/Form')
            ->with($formData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

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
     * @return \Inertia\Response
     */
    public function edit(Product $product)
    {
        if($product->structure==ProductStructure::BOOK){
            $book = Book::query()->with([
                'media',
                'volumes',
                'producer',
                'creators'=>function($creator){
                    $creator->with('types','media');
                },
                'attributeValues'=>function($value) {
                    $value->with('attribute');
                }
            ])->findOrFail($product->id);
            $product = $book;
        }
        $mediaCollections = $product->getRegisteredMediaCollections();
        $product = $product->structure == ProductStructure::BOOK ? BookResource::make($product) : ProductResource::make($product);
        $formData = $this->form->getData();
        $attributes = Helpers::convertResourceToArray(
            new ProductAttributeResourceCollection(
                Attribute::query()
                    ->with(['product_type','children','values'=>function($v){
                            $v->whereHas('attribute',function($q){
                                $q->where('attributes.type', '=', AttributeType::SINGLE_CHOICE);
                            });
                        }
                    ])
                    ->get()
            )
        );
        return Inertia::render('Product/Form')
            ->with(array_merge([
                'attributes'=> $attributes,
                'mediaCollections'=>$mediaCollections,
                'product' => Helpers::convertResourceToArray($product)
            ],$formData));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return Inertia::render('Collection/Create')->with(['errors'=>collect('errors')]);
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
