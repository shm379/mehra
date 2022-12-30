<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class CollectionType extends Enum  implements LocalizedEnum
{
    const PRODUCT = 1;
    const CATEGORY = 2;
    const ATTRIBUTE = 3;
    const CREATOR = 4;
}
