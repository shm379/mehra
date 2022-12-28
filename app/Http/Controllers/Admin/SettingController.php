<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use App\Models\Home;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Home::query()->get();
        // return inertia
        return Inertia::render('Setting/Index')
            ->with(['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }
}
