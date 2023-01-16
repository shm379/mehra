<?php

namespace App\Http\Controllers\Api\Product;

use App\Builder\Includes\AggregateInclude;
use App\Enums\AttributeType;
use App\Enums\ProducerType;
use App\Exceptions\MehraApiException;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\BookResource;
use App\Http\Resources\Api\BookResourceCollection;
use App\Http\Resources\Api\CreatorResourceCollection;
use App\Http\Resources\Api\ProductResource;
use App\Models\Book;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class BookController extends Controller {

    public function index(Request $request)
    {
        // global input search
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                \Illuminate\Database\Eloquent\Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('title', 'LIKE', "%{$value}%");
                });
            });
        });
        // get users from query builder
        $books = QueryBuilder::for(Book::class)
            ->with([
                'productRelated',
                'categories',
                'volume',
                'volumes',
                'producer',
                'creators'=>function($creator){
                    $creator->with('types');
                },
                'attributeValues'=>function($value){
                    $value->with('attribute');
                },
                'medias'
            ])
            ->defaultSort('created_at')
            ->allowedSorts([
            ])
            ->allowedIncludes([
            ])
            ->allowedFilters([
                'volume.title',
                AllowedFilter::exact('categories.id'),
                AllowedFilter::exact('producer_id'),
                AllowedFilter::exact('creators.id'),
                AllowedFilter::exact('collections.id'),
                AllowedFilter::exact('awards.id'),
                AllowedFilter::exact('attributeValues.id'),
                'title',
                $globalSearch])
            ->paginate($this->perPage)
            ->withQueryString();
        return new BookResourceCollection($books);
    }
    public function show(Book $book)
    {
        try {

        } catch (ModelNotFoundException $exception){
            return $this->errorResponse('محصول مورد نظر یافت نشد',404);
        }
        return BookResource::make($book);
    }

    public function filters()
    {
        $awards = \App\Models\Award::query()->pluck('id','title')->toArray();
        $attributes = \App\Models\Attribute::query()->whereIn('slug',[
            'age',
            'format',
            'volume-type',
            'language'
        ])->with('values')->get()->pluck('values')->flatten()->groupBy('name');
        $categories = \App\Models\Category::query()->pluck('id','title')->toArray();
        $creators = \App\Models\Creator::query()->pluck('id','title')->toArray();
        $collections = \App\Models\Collection::query()->pluck('id','title')->toArray();
        $producers = \App\Models\Producer::query()->pluck('id','title')->toArray();
        $filters = [
                'title'=> [
                    'title'=>'عنوان',
                    'key'=> 'title',
                    'icon'=>'',
                    'type'=>0,
                    'value'=> [],
                ],
                'attributes'=> [
                    'title'=>'ویژگی',
                    'key'=> 'attributeValues.id',
                    'icon'=>'',
                    'value'=> $attributes,
                ],
                'awards'=> [
                    'title'=>'جایزه/افتخار',
                    'key'=> 'awards.id',
                    'icon'=>'',
                    'value'=> $awards,
                ],
                'creators' => [
                    'title'=>'پدیدآورنده',
                    'key'=> 'creators.id',
                    'icon'=>'',
                    'value'=> $creators,
                ],
                'categories'=> [
                    'title'=>'دسته‌بندی',
                    'key'=> 'categories.id',
                    'icon'=>'',
                    'value'=> $categories,
                ],
                'collections'=> [
                    'title'=>'مجموعه',
                    'key'=> 'collections.id',
                    'icon'=>'',
                    'value'=> $collections,
                ],
                'producers'=> [
                    'title'=>'ناشر',
                    'key'=> 'producer_id',
                    'icon'=>'',
                    'value'=> $producers,
                ]
        ];
        foreach ($filters as $filter){
            foreach ($attributes as $key=> $attribute){
                $en_name = \Str::slug($attribute->first()->attribute->en_name);
                $filters[$en_name]['key'] = 'attributeValues.id';
                $filters[$en_name]['title'] = $key;
                $filters[$en_name]['icon'] = $attribute->first()->attribute->icon;
                $filters[$en_name]['value'] = $attribute->flatten()->pluck('id','value')->all();
            }
        }
        unset($filters['attributes']);

        return $this->successResponseWithData($filters);
    }
}
