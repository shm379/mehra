<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductType extends Enum
{
    const SIMPLE = 1;
    const VIRTUAL = 2;
}
