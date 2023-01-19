<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SettingType extends Enum
{
    const SLIDER = 1;
    const SALE = 2;
    const CATEGORY = 3;
    const COLLECTION = 4;
    const ANNOUNCEMENT = 5;
    const AUTHOR = 6;
    const PRODUCER = 7;
    const NEWS = 8;
}
