<?php
namespace App\Http\Controllers\Api\Product;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller {

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
        $categories = QueryBuilder::for(Category::class)
            ->with([
                'children',
                'medias',
            ])
            ->whereNull('parent_id')
            ->where('is_active',1)
            ->defaultSort('created_at')
            ->allowedSorts([
            ])
            ->allowedIncludes([
            ])
            ->allowedFilters([
                'title',
                $globalSearch])
            ->paginate($this->perPage)
            ->withQueryString();

        return new CategoryResourceCollection($categories);
    }
    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category->load([
            'medias',
            'parent',
            'children',
            'books'=> function ($b){
                $b->with('medias');
            }
        ]));
    }
}
