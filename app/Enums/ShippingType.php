<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static MANUAL()
 * @method static static TAPIN()
 */
final class ShippingType extends Enum implements LocalizedEnum
{
    const MANUAL = 1;
    const TAPIN = 2;
}
