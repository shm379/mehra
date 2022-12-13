<?php

namespace App\Http\Resources;

use App\Helpers\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentGalleryResourceCollection extends MehraResourceCollection
{
    public $with = ['media'];
}
