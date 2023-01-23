<?php

namespace App\Http\Controllers\Admin;

use App\Models\Creator;
use App\Models\Import;
use App\Services\Admin\Import\WoocommerceService;
use App\Services\Admin\ImportService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ImportController extends Controller
{
    /*
     * Import Service Inject
     */
    protected ImportService $import;
    public function __construct(WoocommerceService $import)
    {
        $this->import = $import;
    }

    /*
     * Create Creator Types
     * Create Creator
     * Attach Creator Type To Creator
     * Create Attribute
     * Create Product
     * Attach Attribute To Product
     */
    public function importFromWoocommerce()
    {
        // Get Creator Types
        $this->import->importCreatorTypes();
        // Get Products
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
