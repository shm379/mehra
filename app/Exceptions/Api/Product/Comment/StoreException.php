<?php

namespace App\Exceptions\Api\Product\Comment;

use App\Exceptions\MehraApiException;

class StoreException extends MehraApiException
{
    public function render($request)
    {
        parent::render($request);
        return response()->json(['success'=>false,'message'=>config('app.debug')? $this->getMessage() :'خطا در عملیات']);
    }
}
