<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static ACCEPTED()
 * @method static static NOT_ACCEPTED()
 */
final class QuestionAnswerStatus extends Enum implements LocalizedEnum
{
    const ACCEPTED = 1;
    const NOT_ACCEPTED = 2;
}
