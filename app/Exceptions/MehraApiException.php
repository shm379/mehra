<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class MehraApiException extends Exception
{
    public function render($request)
    {
        Log::debug($request->fullUrl().' - '.$this->getMessage());
    }
}
