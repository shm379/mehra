<?php

namespace App\Services\Media;

use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Support\FileNamer\FileNamer;

class MehraFileNamer extends FileNamer
{
    private function getFileName($file){
        return \Str::uuid();
    }
    public function originalFileName(string $fileName): string
    {
        return $this->getFileName($fileName);
    }
    public function conversionFileName(string $fileName, Conversion $conversion): string
    {
        $strippedFileName = $this->getFileName($fileName);

        return "{$strippedFileName}-{$conversion->getName()}";
    }

    public function responsiveFileName(string $fileName): string
    {
        return $this->getFileName($fileName);
    }
}
