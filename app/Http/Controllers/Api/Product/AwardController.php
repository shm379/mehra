<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\AwardResource;
use App\Http\Resources\AwardResourceCollection;
use App\Enums\ProductRelatedType;
use App\Models\Award;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AwardController extends Controller {

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
        $awards = QueryBuilder::for(Award::class)
            ->with([
                'media'
            ])
            ->defaultSort('created_at')
            ->allowedSorts([
                'created_at'
            ])
            ->allowedIncludes([
            ])
            ->allowedFilters([
                'title',
                $globalSearch])
            ->paginate($request->has('per_page') !== null ?$request->get('per_page'): 15)
            ->withQueryString();
        return new AwardResourceCollection($awards);
    }
    public function show(Award $award): AwardResource
    {
        return AwardResource::make($award->load([
            'media'
        ]));
    }
}
