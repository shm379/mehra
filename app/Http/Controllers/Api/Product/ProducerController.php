<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\Controller;
use App\Models\Producer;
use App\Http\Resources\ProducerResource;
use App\Http\Resources\ProducerResourceCollection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ProducerController extends Controller {

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
        // get collections from query builder
        $producers = QueryBuilder::for(Producer::class)
            ->with([
                'medias',
                'books'=>function ($b){
                    $b->with('medias');
                },
            ])
            ->defaultSort('created_at')
            ->allowedSorts([
            ])
            ->allowedIncludes([
            ])
            ->allowedFilters([
                'title',
                $globalSearch])
            ->paginate($request->has('per_page') !== null ?$request->get('per_page'): 15)
            ->withQueryString();

        return new ProducerResourceCollection($producers);
    }
    public function show(Producer $producer): ProducerResource
    {
        return ProducerResource::make($producer->load([
            'medias',
            'books'=> function ($b){
                $b->with('medias');
            },
        ]));
    }
}
