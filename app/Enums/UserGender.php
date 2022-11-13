<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static MALE()
 * @method static static FEMALE()
 */
final class UserGender extends Enum implements LocalizedEnum
{
    const MALE = 1;
    const FEMALE = 2;
}
