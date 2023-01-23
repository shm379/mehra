<?php

namespace App\Http\Controllers\Api\Product;

use App\Enums\AttributeType;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\ProductRankAttributeCollection;
use App\Http\Resources\Api\ProductResource;
use App\Models\Creator;
use App\Models\CreatorType;
use App\Models\Import;
use App\Models\Product;
use App\Services\CartService;
use Automattic\WooCommerce\Client;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\WooCommerceApi;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
class ProductController extends Controller {

    public function index(Request $request) : \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $products = Product::query()->with([
            'related',
            'parent',
            'groups',
            'volume',
            'volumes',
            'producer',
            'comments'=>function($comment){
                $comment->with(['medias','user','points','likes'])->where('status',1);
            },
            'creators'=>function($creator){
                $creator->with('types');
            },
            'collections',
            'awards',
            'groups',
            'categories',
            'questions',
            'attributeValues'=>function($value){
                $value->with('attribute');
            },
            'medias'
        ])->paginate($request->has('per_page') !== null ?$request->get('per_page'): 15);
        return ProductResource::collection($products);
    }
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product->load([
            'related',
            'upsell',
            'cross_sell',
            'groups',
            'parent',
            'volume',
            'volumes',
            'producer',
            'comments'=>function($comment){
                $comment->with(['medias','user','points','likes'])->where('status',1);
            },
            'creators'=>function($creator){
                $creator->with('types');
            },
            'collections',
            'awards',
            'groups',
            'categories',
            'questions',
            'attributeValues'=>function($value){
                $value->with('attribute');
            },
            'medias'
        ]));
    }

    public function ranks(Product $product)
    {
        $features = $product->rank_attributes->unique('id');
        return new ProductRankAttributeCollection($features);
    }

    public function reminded(Product $product,$inCart=null)
    {
        $response = [];
        $response['reminded']=$product->max_purchases_per_user;
        if($this->user_id) {
            $product_in_cart = (new CartService())->findCartItemByProductID($product->id);
            if ($product_in_cart != null)
                $response['in_cart'] = $product_in_cart->quantity;
        }
        if($inCart && is_int((int)$inCart)){
            $response['in_cart'] = (int)$inCart;
            if($response['reminded'])
                $response['reminded'] = $response['reminded']-$inCart;

            if($response['reminded']<0)
                $response['reminded'] = 0;
        }

        return $this->successResponseWithData($response);
    }

    /*
     * Create Creator Types
     * Create Creator
     * Attach Creator Type To Creator
     * Create Attribute
     * Create Product
     * Attach Attribute To Product
     */
    public function importJson()
    {
        $products = collect([]);
        for($i=1;$i<=1;$i++){
            $products->push(\Codexshaper\WooCommerce\Models\Product::where('per_page',100)->where('page',$i)->get());
        }

        $products = $products->flatten();
        foreach ($products as $product){
            $meta = collect($product->meta_data);

            if(Import::query()->where('wp_id',$product->id)->where('model_type','product')->doesntExist()) {
                $newItem = [
                    'title' => $product->name,
//                'sku'=> $product->sku=='' ? null : $product->sku,
                    'slug' => $product->slug,
                    'excerpt' => $product->short_description,
                    'description' => $product->description,
                    'structure' => 1,
                    'type' => 1,
                    'is_virtual' => $product->virtual,
                    'price' => $product->regular_price,
                    'sale_price' => $product->sale_price,
                    'is_available' => 1,
                    'is_active' => 1,
                    'max_purchases_per_user' => null,
                    'weight' => $product->weight
                ];
                $newProduct = Product::query()->create($newItem);
                Import::query()->create([
                    'model_id' => $newProduct->id,
                    'model_type' => 'product',
                    'wp_id' => $product->id
                ]);
            }

            $no_acf_fields = $meta->filter(function ($item) {
                if(is_array($item->value)) return true;
                return !preg_match('/^field_/', $item->value);
            });
            $authors = $no_acf_fields->where('key','author-books')->first();

        }

    }
}
