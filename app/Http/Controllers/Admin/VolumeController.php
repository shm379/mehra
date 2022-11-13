<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VolumesDataTableEditor;
use App\Http\Controllers\Admin;
use App\Models\Volume;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volumes = Volume::query()->withCount('products');
//        foreach ($volumes as $volume) {
//            if($volume->products){
//                foreach ($volume->products as $productKey => $product){
//                    $volume->products[$productKey] = $product->title;
//                }
//            }
//        }
        if(\request()->ajax()){
            return DataTables::of($volumes)
                ->searchPane(
                /*
                 * This is the column for which this SearchPane definition is for
                 */
                    'title',

                    /*
                     * Here we define the options for our SearchPane. This should be either a collection or an array with the
                     * form:
                     * [
                     *     [
                     *          'value' => 1,
                     *          'label' => 'display value',
                     *          'total' => 5, // optional
                     *          'count' => 3 // optional
                     *     ],
                     *     [
                     *          'value' => 2,
                     *          'label' => 'display value 2',
                     *          'total' => 6, // optional
                     *          'count' => 5 // optional
                     *     ],
                     * ]
                     */
                    fn() => Volume::query()->select('id as value', 'title as label')->get(),

                    /*
                     * This is the filter that gets executed when the user selects one or more values on the SearchPane. The
                     * values are always given in an array even if just one is selected
                     */
                    function (\Illuminate\Database\Eloquent\Builder $query, array $values) {
                        return $query
                            ->whereIn(
                                'id',
                                $values);
                    }
                )
                ->make();
        }
        return view('admin.volumes.index', compact('volumes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.volumes.create');
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
     * @param  \App\Models\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function show(Volume $volume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function edit(Volume $volume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volume $volume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volume $volume)
    {
        //
    }
}
