<?php

namespace App\Services\Media;


use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{


    public static function getTableName()
    {
        return 'media';
    }

    public function getThumbnailAddressAttribute()
    {
        return $this->getUrl('thumbnail');
    }

    public function assign($model, $collectionName)
    {
        $this->collection_name = $collectionName;
        $model->media()->save($this);
    }
}
