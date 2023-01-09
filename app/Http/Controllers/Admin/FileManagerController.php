<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Global\FileManagerBrowseRequest;
use App\Http\Resources\Admin\FileManagerResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class FileManagerController extends Controller
{
    public function browse(FileManagerBrowseRequest $request)
    {
        if($request->has('path')){
            $files = \Storage::disk(config('media-library.disk_name'))->allFiles($request->get('path'));
        } else {
            $files = \Storage::disk(config('media-library.disk_name'))->allFiles();
        }
        if($request->has('ext')){

        }
        // return file manager
        return new FileManagerResourceCollection($files);
    }
    public function upload(Request $request)
    {

        // return file manager
        return response()->json([

        ]);
    }
}
