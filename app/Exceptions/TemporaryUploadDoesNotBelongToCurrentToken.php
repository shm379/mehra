<?php

namespace App\Exceptions;

use Exception;

class TemporaryUploadDoesNotBelongToCurrentToken extends MehraApiException
{
    public static function create(): self
    {
        return new static('The session id of the given temporary upload does not match the current session id.');
    }
}
