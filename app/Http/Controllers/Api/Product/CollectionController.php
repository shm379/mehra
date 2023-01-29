<?php
namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\CollectionResource;
use App\Http\Resources\Api\CollectionResourceCollection;
use App\Models\Collection;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CollectionController extends Controller {

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
        $collections = QueryBuilder::for(Collection::class)
            ->with([
                'medias',
                'products',
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

        return new CollectionResourceCollection($collections);
    }
    public function show(Collection $collection): CollectionResource
    {
        return CollectionResource::make($collection);
    }
}
