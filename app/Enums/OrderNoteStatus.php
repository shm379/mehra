<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static SUCCESS()
 * @method static static FAILURE()
 */
final class OrderNoteStatus extends Enum implements LocalizedEnum
{
    const SUCCESS = 1;
    const FAILURE = 2;
}
