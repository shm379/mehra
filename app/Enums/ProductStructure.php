<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductStructure extends Enum
{
    const BOOK = 1;
    const STATIONERY = 2;
    const CRAFT = 3;
    const PRODUCT = 4;
}
