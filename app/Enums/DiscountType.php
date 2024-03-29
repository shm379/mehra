<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static COUPON()
 * @method static static PRODUCT()
 */
final class DiscountType extends Enum implements LocalizedEnum
{
    const COUPON = 1;
    const PRODUCT = 2;
}
