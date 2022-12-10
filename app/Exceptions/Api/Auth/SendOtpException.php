<?php

namespace App\Exceptions\Api\Auth;

use App\Exceptions\MehraApiException;

class SendOtpException extends MehraApiException
{
    public function render($request)
    {
        parent::render($request);
        return response()->json(['success'=>false,'message'=>'ارسال کد با مشکل مواجه شده است']);
    }
}
