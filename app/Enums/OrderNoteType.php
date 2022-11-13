<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static SYSTEM()
 * @method static static ADMIN()
 */
final class OrderNoteType extends Enum implements LocalizedEnum
{
    const SYSTEM = 1;
    const ADMIN = 2;
}
