<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static STANDARD()
 * @method static static LANDING()
 */
final class PageType extends Enum implements LocalizedEnum
{
    const STANDARD = 1;
    const LANDING = 2;
}
