<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AwardType;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\StoreAwardRequest;
use App\Models\Award;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class AwardController extends Controller
{
    public $model = Award::class;
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
                        ->orWhere('title', 'LIKE', "%{$value}%")
                        ->orWhere('description', 'LIKE', "%{$value}%");
                });
            });
        });
        // get per page number
        $per_page = abs($request->perPage) > 0 ? abs($request->perPage) : 15;
        QueryBuilderRequest::setArrayValueDelimiter('|');
        // get users from query builder
        $awards = QueryBuilder::for(Award::class)
            ->defaultSort('created_at')
            ->allowedSorts([
            ])
            ->allowedIncludes([
            ])
            ->allowedFilters([
                $globalSearch])
            ->paginate($per_page)
            ->through(function ($award) {
                return [
                    'id' => $award->id,
                    'title' => $award->title,
                    'parent' => optional($award->parent)->title,
                    'slug' => $award->slug,
                    'type' => AwardType::getDescription((int)$award->award_type),
                ];
            })
            ->withQueryString();
        // return table in inertia with columns
        return Inertia::render('Award/Index')
            ->with(['awards' => $awards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $types = AwardType::asSelectArray();
        $parentAwards = Award::parentAwards();
        return Inertia::render('Award/Create')->with(['types'=> $types,'parent_awards'=>$parentAwards]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAwardRequest $request)
    {
        Award::query()->create($request->validated());
        session('success','عملیات با موفقیت انجم');
        return Inertia::render('Award/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Award $award)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        //
    }
}
