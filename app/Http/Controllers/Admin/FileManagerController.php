<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Global\FileManagerBrowseRequest;
use App\Http\Resources\Admin\FileManagerResourceCollection;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class FileManagerController extends Controller
{
    public function browse(FileManagerBrowseRequest $request)
    {
        $path = $request->get('path') ?? null;
        $media = Media::query()->get();
        if($request->has('ext')){
            $ext = $request->get('ext');

        }
        // return file manager
        return response()->json(new FileManagerResourceCollection($media));
    }
    public function upload(Request $request)
    {

        // return file manager
        return response()->json([

        ]);
    }
}
