<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductGroupType extends Enum
{
    const GROUPED = 1;
    const PACKAGE = 2;
}
