<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class CommentStatus extends Enum implements LocalizedEnum
{
    const PENDING = 1;
    const APPROVED = 2;
}
