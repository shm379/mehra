<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MenuPosition extends Enum
{
    const HEADER = 1;
    const FOOTER_RIGHT = 2;
    const FOOTER_MIDDLE = 3;
    const FOOTER_LEFT = 4;
}
