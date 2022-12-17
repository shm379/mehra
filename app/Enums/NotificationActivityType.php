<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class NotificationActivityType extends Enum implements LocalizedEnum
{
    const MESSAGE = 1;
    const COMMENT_LIKE = 2;
    const COMMENT_REPLY = 3;
    const ADMIN = 4;
}
