<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DiscountCreatorType extends Enum
{
    const MANAGER = 1;
    const SYSTEM = 2;
}
