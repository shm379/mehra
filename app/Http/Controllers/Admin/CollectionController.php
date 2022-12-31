<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CollectionType;
use App\Models\Category;
use App\Models\CategoryTemplate;
use App\Models\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        // global input search
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                \Illuminate\Database\Eloquent\Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhereRaw("concat(first_name, ' ', last_name) like '%$value%' ")
                        ->orWhere('mobile', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        // get per page number
        $per_page = abs($request->perPage) > 0 ? abs($request->perPage) : 15;
        QueryBuilderRequest::setArrayValueDelimiter('|');
        // get users from query builder
        $collections = QueryBuilder::for(Collection::class)
            ->defaultSort('created_at')
            ->allowedSorts([
                'email',
                'mobile',
                'comments_count',
                'created_at',
                'wallets.balance',
            ])
            ->allowedIncludes(['comments','wallet'])
            ->allowedFilters([
                'comments_count',
                'wallets.balance',
                'city',
                'email',
                'gender',
                $globalSearch])
            ->paginate($per_page)
            ->through(function ($collection) {
                return [
                    'id' => $collection->id,
                    'title' => $collection->title,
                    'description'=> $collection->description,
                    'slug'=> $collection->slug,
                    'type'=> CollectionType::getDescription($collection->type),
                    'is_private'=> (bool)$collection->is_private,
                    'user'=> $collection->admin_id ? $collection->admin->name : $collection->user->name,
                ];
            })
            ->withQueryString();
        // return table in inertia with columns
        return Inertia::render('Collection/Index')
            ->with(['collections' => $collections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Collection/Create')->with(['errors'=>collect('errors')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
