<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductRelatedType extends Enum
{
    const RELATED = 1;
    const UPSELL = 2;
    const CROSS_SELL = 3;
}
