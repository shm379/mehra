<?php
namespace App\Services\Admin\Import;

use App\Enums\ProductStructure;
use App\Enums\ProductType;
use App\Models\Creator;
use App\Models\CreatorType;
use App\Models\Import;
use App\Models\Product;
use App\Services\Admin\ImportService;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;

class WoocommerceService extends ImportService
{

    protected $url;

    public function __construct()
    {
        parent::__construct();
        $this->url = config('woocommerce.store_url');

    }

    public function getFromImported($list,$type)
    {
        $model_ids = [];
        $import = Import::query()->where('model_type',$type);
        if(!is_array($list)){
            $list = [$list];
        }
        $model_ids = $import->whereIn('wp_id',$list)->pluck('model_id')->toArray();
        return $model_ids;
    }

    public function getCreatorTypes()
    {
        $types = Taxonomy::where('taxonomy','expertise-of-artists')->get();
        return $types;

    }
    public function getCreators()
    {
        $creators = Post::where('post_type','the-creators')->get();
        return $creators;
    }
    public function getProducts()
    {
        $all_products = [];
        $products = \Codexshaper\WooCommerce\Models\Product::where('per_page','100')->where('page',1)->get();
        if(count($products)==100){
            $all_products[] = $products;
            $products = \Codexshaper\WooCommerce\Models\Product::where('per_page','100')->where('page',2)->get();
            $all_products[] = $products;
        } else {
            $all_products[] = $products;
        }
        return collect($all_products)->flatten();
    }
    public function importCreatorTypes()
    {
        $creatorTypes = $this->getCreatorTypes();
        foreach ($creatorTypes as $creatorType){
            if(! $this->isImportedBefore($creatorType->term_id,'creator_type')) {
                $created_id = CreatorType::query()->create([
                    'name' => $creatorType->term->name,
                    'plural_name' => $creatorType->term->name
                ]);
                $this->imported($creatorType->term_id, $created_id->id, 'creator_type');
            }
        }
    }
    public function importCreators()
    {
        $creators = $this->getCreators();
        foreach ($creators as $creator){
            if(! $this->isImportedBefore($creator->ID,'creator')) {
                $gender = null;
                if ($creator->hasMeta('mehrak_gender')) {
                    $gender = $creator->getMeta('mehrak_gender') == 'male' ? 1 : 2;
                }
                $name = $creator->title;
                $types = $this->getFromImported($creator->taxonomies->pluck('term_taxonomy_id')->toArray(), 'creator_type');
                $description = $creator->content;
                $created_id = Creator::query()->create([
                    'name' => $name,
                    'gender' => $gender,
                    'description' => $description
                ]);
                $created_id->types()->attach($types);
                $this->imported($creator->ID, $created_id->id, 'creator');
            }
        }
    }
    public function importProducts()
    {
        $products = $this->getProducts();
        $attributes = [
            'print_year',
            'number_pages',
            'ISBN',
            'Published',
            'ages',
            'applications',
            'book-genre',
        ];
        $related_items = [];
        foreach ($products as $product){
            $newItem = [
                'title' => $product->name,
//                'sku'=> $product->sku=='' ? null : $product->sku,
                'slug' => $product->slug,
                'excerpt' => $product->short_description,
                'description' => $product->description,
                'structure' => ProductStructure::BOOK,
                'type' => ProductType::PRINTED_BOOK,
                'is_virtual' => $product->virtual,
                'price' => $product->regular_price,
                'sale_price' => $product->sale_price,
                'is_available' => 1,
                'is_active' => 1,
                'max_purchases_per_user' => null,
                'weight' => $product->weight,
            ];
            if(! $this->isImportedBefore($product->id,'product')) {
                dd($product->Author_Books);

                dd($product->Cover_Desiger_Book); // [426]
                dd($product->Illustrator_Book);// [212,426]
                dd($product->Graphic_Designer_Book); // [3125]
                $creators = $this->getFromImported(collect($product->creators)->flatten()->pluck('ID')->toArray(),'creator');

                $description = $product->content;
                $created_id = Product::query()->create($newItem);
//                $created_id->creators()->attach($creators,['creator_creator_type_id'=>]);
                $related_items[$created_id->id] = $product->related_ids;

                $this->imported($product->ID, $created_id->id, 'product');
            }
        }
        $this->importRelatedProducts($related_items);
    }

}
