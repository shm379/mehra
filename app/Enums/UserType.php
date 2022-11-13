<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static PERSON()
 * @method static static COMPANY()
 */
final class UserType extends Enum implements LocalizedEnum
{
    const PERSON = 1;
    const COMPANY = 2;
}
