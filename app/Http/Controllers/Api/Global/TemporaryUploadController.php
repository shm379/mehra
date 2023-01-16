<?php

namespace App\Http\Controllers\Api\Global;

use App\Exceptions\MehraApiException;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Product\TemporaryUploadRequest;
use App\Models\ModelHasMedia;
use App\Models\TemporaryUpload;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TemporaryUploadController extends Controller {

    public function __invoke(TemporaryUploadRequest $request)
    {
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        try {
            $temporaryUpload = $temporaryUploadModelClass::createForFile(
                $request->file,
                session()->getId(),
                $request->uuid,
                $request->name ?? '',
            );
        } catch (MehraApiException $exception) {
            $temporaryUploadModelClass::query()
                ->where('session_id', session()->getId())
                ->get()->each->delete();


            report($exception);

            throw ValidationException::withMessages(['file' => 'Could not handle upload. Make sure you are uploading a valid file.']);
        }

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media */
        $media = $temporaryUpload->getFirstMedias();
        return response()->json($this->responseFields($media, $temporaryUpload));
    }

    protected function responseFields(Media $media, TemporaryUpload $temporaryUpload): array
    {
        return [
            'uuid' => $media->uuid,
            'name' => $media->name,
            'preview_url' => config('media-library.generate_thumbnails_for_temporary_uploads')
                ? $temporaryUpload->getFirstMediaUrl('default', 'preview')
                : '',
            'size' => $media->size,
            'mime_type' => $media->mime_type,
            'extension' => $media->extension,
        ];
    }
}
