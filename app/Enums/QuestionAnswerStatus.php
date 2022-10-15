<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class QuestionAnswerStatus extends Enum
{
    const ACCEPTED = 1;
    const NOT_ACCEPTED = 2;
}
