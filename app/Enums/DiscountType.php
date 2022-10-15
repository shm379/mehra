<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DiscountType extends Enum
{
    const COUPON = 1;
    const PRODUCT = 2;
}
