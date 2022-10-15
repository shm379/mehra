<?php

namespace App\Services\Media;

use App\Models\FakeModel;
use Illuminate\Database\Eloquent\Model;

class MediaHelper
{

    public static function storeMediaFor(Model $model, string $batchId = null)
    {
        if (is_null($batchId)) {
            $batchId = request()->input('file_batch_id');
        }

        $modelName = array_search(get_class($model), config('morphmap'));

        if ($fakeModel = FakeModel::where('batch_id', $batchId)->where('model_name', $modelName)->first()) {

            foreach ($fakeModel->media()->get() as $media) {
                $fileName = $media->file_name;
                if ($modelName === 'model') {
                    $fileName = explode('.', $media->file_name);
                    $fileName = $model->user->first_name . '.' . end($fileName);
                }
                $media->move($model, $media->collection_name, '', $fileName);
            }

            $fakeModel->delete();

        }

    }

    public static function storeMediaForMultiModel(Array $models, string $batchId = null)
    {
        if (is_null($batchId)) {
            $batchId = request()->input('file_batch_id');
        }

        if (isset($models[0])) {
            $modelName = array_search(get_class($models[0]), config('morphmap'));

            if ($fakeModel = FakeModel::where('batch_id', $batchId)->where('model_name', $modelName)->first()) {
                foreach ($models as $model) {
                    if ($fakeModel) {
                        foreach ($fakeModel->media()->get() as $media) {
                            $media->copy($model, $media->collection_name);
                        }
                    }
                }
                $fakeModel->delete();
            }
        }

    }
    public static function moveStoreMediaFor($old_collection_name,$collection_name,Model $model, string $batchId = null)
    {
        if (is_null($batchId)) {
            $batchId = request()->input('file_batch_id');
        }

        $modelName = array_search(get_class($model), config('morphmap'));

        if ($fakeModel = FakeModel::where('batch_id', $batchId)->where('model_name', $modelName)->first()) {

            foreach ($fakeModel->media()->get() as $media) {
                $fileName = $media->file_name;
                if ($modelName === 'model') {
                    $fileName = explode('.', $media->file_name);
                    $fileName = $model->user->first_name . '.' . end($fileName);
                }
                $media->move($model, $collection_name, '', $fileName);
            }

            foreach ($model->media()->where('collection_name',$old_collection_name)->get() as $media_old) {
                if($media_old->collection_name==$old_collection_name){
                    $media_old->update(['collection_name'=>$collection_name]);
                }
            }
            $fakeModel->delete();

        }

    }

}
