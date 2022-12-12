<?php

namespace App\Exceptions\Api\Profile\Address;

use App\Exceptions\MehraApiException;

class UpdateException extends MehraApiException
{
    public function render($request)
    {
        parent::render($request);
        return response()->json(['success'=>false,'message'=>config('app.debug')? $this->getMessage() :'خطا در عملیات']);
    }
}
