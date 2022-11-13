<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\CategoryTemplate;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->withAggregate('template','name');
        if(\request()->ajax()){

            return DataTables::of($categories)
                ->editColumn('template',function ($category){
                    if($category->template){
                        return $category->template->name;
                    }
                })
                ->editColumn('option',function ($category){
                    return \view('admin.components.table.option',[
                        'keys' => [],
                        'show' => true,
                        'edit' => true,
                        'delete' => true,
                        'model' => $category,
                        'deleteRoute' => route('admin.categories.destroy',$category->id),
                        'editRoute' => route('admin.categories.edit',$category->id),
                        'showRoute' => route('admin.categories.show',$category->id),

                    ]);
                })
                ->make();
        }
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::query()->get();
        $categoryTemplates = CategoryTemplate::query()->get();
        return view('admin.categories.create',compact(['parentCategories','categoryTemplates']))->with(['errors'=>collect('errors')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
