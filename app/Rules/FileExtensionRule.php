<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileExtensionRule implements Rule
{
    protected array $validExtensions = [];

    public function __construct(array $validExtensions = [])
    {
        $this->validExtensions = array_map(
            fn (string $extension) => strtolower($extension),
            $validExtensions,
        );
    }

    /**
     * @param string $attribute
     * @param \Illuminate\Http\UploadedFile $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $value->getClientOriginalExtension() !== null && in_array(
            strtolower($value->getClientOriginalExtension()),
            $this->validExtensions,
            strict: true,
        );
    }

    public function message(): string
    {
        return trans('validation.media.mime', [
            'mimes' => implode(', ', $this->validExtensions),
        ]);
    }
}
