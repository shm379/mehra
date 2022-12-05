<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ProductType extends Enum implements LocalizedEnum
{
    const PRINTED_BOOK = 1;
    const SOUND_BOOK = 2;
    const EBOOK = 3;
    const CD = 4;
    const TEST = 5;
}
