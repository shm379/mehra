<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\ApiFormRequest;
use App\Rules\FileExtensionRule;
use Illuminate\Foundation\Http\FormRequest;

class TemporaryUploadRequest extends ApiFormRequest
{
    public function rules(): array
    {
        $configuredAllowedExtensions = config('media-library.temporary_uploads_allowed_extensions');

        $allowedExtensions = $configuredAllowedExtensions ?? \App\Services\Media\DefaultAllowedExtensions::all();

        $allowedExtensionsString = implode(',', $allowedExtensions);

        return [
            'uuid' => "unique:{$this->getDatabaseConnection()}{$this->getMediaTableName()}",
            'name' => '',
            'custom_properties' => '',
            'file' => [
                'max:' . config('media-library.max_file_size') / 1024,
                "mimes:" . $allowedExtensionsString,
                new FileExtensionRule($allowedExtensions),
            ],
        ];
    }

    protected function getDatabaseConnection(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        if ($mediaModel->getConnectionName() === 'default') {
            return '';
        }

        return "{$mediaModel->getConnectionName()}.";
    }

    protected function getMediaTableName(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        return $mediaModel->getTable();
    }

    protected function prepareForValidation()
    {
        $this->merge([
           'uuid' => \Str::uuid()
        ]);
    }

    public function messages()
    {
        return [
            'uuid.unique' => trans('medialibrary-pro::upload_request.uuid_not_unique'),
        ];
    }
}
