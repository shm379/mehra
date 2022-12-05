<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class StockType extends Enum implements LocalizedEnum
{
    const AUTO = 1;
    const MANUAL = 2;
}
