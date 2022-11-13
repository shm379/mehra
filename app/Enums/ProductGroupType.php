<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static GROUPED()
 * @method static static PACKAGE()
 */
final class ProductGroupType extends Enum implements LocalizedEnum
{
    const GROUPED = 1;
    const PACKAGE = 2;
}
