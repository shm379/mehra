<?php

namespace App\Exceptions\Api\Cart;

use App\Exceptions\MehraApiException;

class AddItemException extends MehraApiException
{
    public function render($request)
    {
        parent::render($request);
        return response()->json(['success'=>false,'message'=>config('app.debug')? $this->getMessage() :'خطا در عملیات']);
    }
}
