<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\Controller;
use App\Models\Creator;
use App\Http\Resources\Api\CreatorResource;
use App\Http\Resources\Api\CreatorResourceCollection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class CreatorController extends Controller {

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
        $creators = QueryBuilder::for(Creator::class)
            ->with([
                'medias',
                'books'=>function ($b){
                    $b->with('medias');
                },
                'awards'=>function ($a){
                    $a->with('medias');
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

        return new CreatorResourceCollection($creators);
    }
    public function show(Creator $creator): CreatorResource
    {
        return CreatorResource::make($creator->load([
            'medias',
            'books'=> function ($b){
                $b->with('medias');
            },
            'awards'=>function ($a){
                $a->with('medias');
            },
        ]));
    }
}
