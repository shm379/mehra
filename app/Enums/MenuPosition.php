<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static HEADER()
 * @method static static FOOTER_RIGHT()
 * @method static static FOOTER_MIDDLE()
 * @method static static FOOTER_LEFT()
 */
final class MenuPosition extends Enum implements LocalizedEnum
{
    const HEADER = 1;
    const FOOTER_RIGHT = 2;
    const FOOTER_MIDDLE = 3;
    const FOOTER_LEFT = 4;
}
