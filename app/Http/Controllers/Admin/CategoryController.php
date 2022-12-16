<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;
use App\Models\CategoryTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $categories = QueryBuilder::for(Category::class)
            ->withAggregate('template', 'name')
            ->defaultSort('created_at')
            ->allowedSorts([
                'email',
                'mobile',
                'comments_count',
                'created_at',
                'wallets.balance',
            ])
            ->allowedIncludes(['comments', 'wallet'])
            ->allowedFilters([
                'comments_count',
                'wallets.balance',
                'city',
                'email',
                'gender',
                $globalSearch
            ])
            ->paginate($per_page)
            ->through(function ($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'description' => $category->description,
                    'slug' => $category->slug,
                    'template' => $category->template_name
                ];
            })
            ->withQueryString();
        // return table in inertia with columns
        return Inertia::render('Category/Index')
            ->with(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = CategoryTemplate::all();
        return Inertia::render('Category/Create')->with('templates', $templates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::query()->create($request->validated());
        if($category){
            return Redirect::route('admin.categories.index')
                ->with([
                    'flash'=>['success'=>'عملیات با موفقیت انجام شد!'],
                ]);
        } else {
            return Inertia::render('Category/Create')
                ->with([
                    'flash'=>['error'=>'عملیات شکست خورد!'],
                ]);
        }
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
