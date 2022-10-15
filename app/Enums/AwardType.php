<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AwardType extends Enum
{
    const AWARD = 1;
    const HONOR = 2;
    const FAVORITE = 3;
    const RECOMMENDATION = 4;
    const INTRODUCTION = 5;
}
