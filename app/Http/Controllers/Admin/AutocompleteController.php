<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttributeType;
use App\Enums\CollectionType;
use App\Enums\ProductStructure;
use App\Enums\ProductType;
use App\Http\Resources\Admin\BookAttributeResourceCollection;
use App\Http\Resources\Admin\BookAttributeValueResource;
use App\Http\Resources\Admin\BookAttributeValueResourceCollection;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Award;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Creator;
use App\Models\City;
use App\Models\CreatorType;
use App\Models\Producer;
use App\Models\Product;
use App\Models\Volume;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function authors($q, Request $request)
    {
        return Creator::authors($q);
    }

    public function translators($q, Request $request)
    {
        return Creator::translators($q);
    }

    public function narrators($q, Request $request)
    {
        return Creator::narrators($q);
    }

    public function illustrators($q, Request $request)
    {
        return Creator::illustrators($q);
    }

    public function publishers($q, Request $request)
    {
        return Producer::publishers($q);
    }

    public function volumes($q, Request $request)
    {
        if($q){
            return Volume::where('title', 'like' , "%$q%")->get();
        }
        return Volume::get();
    }

    public function brands($q, Request $request)
    {
        return Producer::brands($q);
    }

    public function producers($q, Request $request)
    {
        return Producer::producers($q);
    }

    public function categories($q, Request $request)
    {
        $result = Category::query()->where('title', 'LIKE', '%' . $q . '%')->get();
        return $result;
    }
    public function attributes(Request $request)
    {
        return new BookAttributeResourceCollection(
            Attribute::query()
                ->with(['children'])
                ->whereNull('parent_id')
                ->get()
        );
    }
    public function productsByAttributeValueId($id)
    {
        return AttributeValue::query()
                ->with('products')
                ->find($id);
    }
    public function attributeValues($id)
    {
        return AttributeValue::query()
                ->with('products')
                ->find($id);
    }
    public function attributeValuesById($id,$title='')
    {
        $attributeValue =
            AttributeValue::query()
                ->where('attribute_id',$id);
        if($title!='')
            $attributeValue
                ->where('value','LIKE','%'.$title.'%');

        return new BookAttributeValueResourceCollection(
            $attributeValue->get()
        );
    }
    public function attributeTypes(Request $request)
    {
        return array_flip(AttributeType::asArray());
    }
    public function collectionTypes(Request $request)
    {
        $collection_types = [];
        $collectionTypes = array_flip(CollectionType::asArray());
        foreach ($collectionTypes as $i=> $collectionType){
            $collection_types[] = ['label'=>CollectionType::getDescription($i),'value'=>$i];
        }
        return $collection_types;
    }
    public function award($q, Request $request)
    {
        return Award::query()->where('title', 'LIKE', "%$q%")->get();
    }
    public function collections($q, Request $request)
    {
        return Collection::query()->where('title', 'LIKE', "%$q%")->get();
    }
    public function products($q, Request $request)
    {
        return Product::query()->where('title', 'LIKE', "%$q%")->get();
    }
    public function creatorTypes($q, Request $request)
    {
        return CreatorType::query()->where('name', 'LIKE', "%$q%")->get();
    }
    public function cities($q, Request $request)
    {
        return City::query()->where('title', 'LIKE', "%$q%")->get();
    }
    public function productTypes(Request $request)
    {
        $types = [];
        $productTypes = array_flip(ProductType::asArray());
        foreach ($productTypes as $i=> $productType){
            $types[] = ['label'=>ProductType::getDescription($i),'value'=>$i];
        }
        return $types;
    }
    public function productStructures(Request $request)
    {
        $structures = [];
        $productStructures = array_flip(ProductStructure::asArray());
        foreach ($productStructures as $i=> $productStructure){
            $structures[] = ['label'=>ProductStructure::getDescription($i),'value'=>$i];
        }
        return $structures;
    }
}
