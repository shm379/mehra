<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static MANAGER()
 * @method static static SYSTEM()
 */
final class DiscountCreatorType extends Enum implements LocalizedEnum
{
    const MANAGER = 1;
    const SYSTEM = 2;
}
