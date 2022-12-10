<?php

namespace App\Exceptions\Api\Cart;

use App\Exceptions\ApiException;

class AddItemException extends ApiException
{
    public function render($request)
    {
        parent::render($request);
        return response()->json(['success'=>false,'message'=>config('app.debug')? $this->getMessage() :'خطا در عملیات']);
    }
}
