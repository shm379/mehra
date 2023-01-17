<?php

namespace App\Exceptions;

use Exception;

class CouldNotAddUpload extends MehraApiException
{
    public static function uuidAlreadyExists()
    {
        return new static("The given uuid is being used for an existing media item.");
    }
}
