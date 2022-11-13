<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static AWARD()
 * @method static static HONOR()
 * @method static static FAVORITE()
 * @method static static RECOMMENDATION()
 * @method static static INTRODUCTION()
 */
final class AwardType extends Enum implements LocalizedEnum
{
    const AWARD = 1;
    const HONOR = 2;
    const FAVORITE = 3;
    const RECOMMENDATION = 4;
    const INTRODUCTION = 5;
}
