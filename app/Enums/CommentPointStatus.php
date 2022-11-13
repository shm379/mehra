<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static POSITIVE()
 * @method static static NEGATIVE()
 */
final class CommentPointStatus extends Enum implements LocalizedEnum
{
    const POSITIVE = 1;
    const NEGATIVE = 2;
}
