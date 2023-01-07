<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait AdminResponse
{

    protected function successResponse($message, $code = 200): JsonResponse
    {
        return redirect()->back()->with([

        ]);
    }
    protected function successResponseWithData($data, $code = 200): JsonResponse
    {
        return response()->json([
                'success' => true,
                'data'=> $data,

            ], $code);
    }

    protected function errorResponse($message, $code= 200): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data'=>[
                'message' => $message,
                ]
            ], $code);
    }

}
