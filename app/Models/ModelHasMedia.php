<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ModelHasMedia extends MorphPivot
{

    protected $guarded = [];
    protected $with = ['medias'];
    public $timestamps = false;
    public function media()
    {
        return $this->belongsTo(config('media-library.media_model'));
    }

}
