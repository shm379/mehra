<?php

namespace App\Models;

use App\Services\Media\HasMediaTrait;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Exceptions\CouldNotAddUpload;
use App\Exceptions\TemporaryUploadDoesNotBelongToCurrentToken;

class TemporaryUpload extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = [];


    public static function getValidCollections(): array
    {
        return [
            'comment',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('comment')
            ->useDisk(config('media-library.disk_name'))
            ->singleFile();
    }
    public static ?Closure $manipulatePreview = null;

    public static ?string $disk = null;

    public function scopeOld(Builder $builder): void
    {
        $builder->where('created_at', '<=', Carbon::now()->subDay()->toDateTimeString());
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if (! config('media-library.generate_thumbnails_for_temporary_uploads')) {
            return;
        }

        $conversion = $this
            ->addMediaConversion('preview')
            ->nonQueued();

        $previewManipulation = $this->getPreviewManipulation();

        $previewManipulation($conversion);
    }

    public static function previewManipulation(Closure $closure): void
    {
        static::$manipulatePreview = $closure;
    }

    protected function getPreviewManipulation(): Closure
    {
        return static::$manipulatePreview ?? function (Conversion $conversion) {
            $conversion->fit(Manipulations::FIT_CROP, 300, 300);
        };
    }

    protected static function getDiskName(): string
    {
        return static::$disk ?? config('media-library.disk_name');
    }

    public static function findByMediaUuid(?string $mediaUuid): ?TemporaryUpload
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var Media $media */
        $media = $mediaModelClass::query()
            ->where('uuid', $mediaUuid)
            ->first();

        if (! $media) {
            return null;
        }

        $temporaryUpload = $media->model;

        if (! $temporaryUpload instanceof TemporaryUpload) {
            return null;
        }

        return $temporaryUpload;
    }

    public static function findByMediaUuidInCurrentToken(?string $mediaUuid): ?TemporaryUpload
    {
        if (! $temporaryUpload = static::findByMediaUuid($mediaUuid)) {
            return null;
        }
        if (config('media-library.enable_temporary_uploads_session_affinity', true)) {
            if ($temporaryUpload->token !== request()->bearerToken()) {
                return null;
            }
        }

        return $temporaryUpload;
    }

    public static function createForFile(
        UploadedFile $file,
        string $token,
        string $uuid,
        string $name
    ): self {
        /** @var \App\Models\TemporaryUpload $temporaryUpload */
        $temporaryUpload = static::create([
            'token' => $token,
        ]);

        if (static::findByMediaUuid($uuid)) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $media = $temporaryUpload
            ->addMedia($file)
            ->setName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());

        ModelHasMedia::query()->create([
            'media_id'=> $media->id,
            'model_id'=> $media->model_id,
            'model_type'=> $media->model_type,
            'collection_name'=> 'default',
            'order'=>1
        ]);
        return $temporaryUpload->fresh();
    }

    public static function createForRemoteFile(
        string $file,
        string $token,
        string $uuid,
        string $name,
        string $diskName
    ): self {
        /** @var \Spatie\MediaLibraryPro\Models\TemporaryUpload $temporaryUpload */
        $temporaryUpload = static::create([
            'token' => $token,
        ]);

        if (static::findByMediaUuid($uuid)) {
            throw CouldNotAddUpload::uuidAlreadyExists();
        }

        $media = $temporaryUpload
            ->addMediaFromDisk($file, $diskName)
            ->setName($name)
            ->usingFileName($name)
            ->withProperties(['uuid' => $uuid])
            ->toMediaCollection('default', static::getDiskName());

        ModelHasMedia::query()->create([
            'media_id'=> $media->id,
            'model_id'=> $media->model_id,
            'model_type'=> $media->model_type,
            'collection_name'=> 'default',
            'order'=>1
        ]);
        return $temporaryUpload->fresh();
    }

    public function moveMedia(HasMedia $toModel, string $collectionName, string $diskName='', string $fileName=''): Media
    {
        if (config('media-library.enable_temporary_uploads_session_affinity', true)) {
            if ($this->token !== request()->bearerToken()) {
                throw TemporaryUploadDoesNotBelongToCurrentToken::create();
            }
        }

        $media = $this->getFirstMedias();

        $temporaryUploadModel = $media->model;
        $uuid = $media->uuid;

        $newMedia = $media->move($toModel, $collectionName, $diskName, $fileName);

        $temporaryUploadModel->delete();

        ModelHasMedia::query()->create([
            'media_id'=> $newMedia->id,
            'model_id'=> $newMedia->model_id,
            'model_type'=> $newMedia->model_type,
            'collection_name'=> $collectionName,
            'order'=>1
        ]);

        $newMedia->update(compact('uuid'));

        return $newMedia;
    }
}
