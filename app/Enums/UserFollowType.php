<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserFollowType extends Enum
{
    const FOLLOWING = 1;
    const FOLLOWER = 2;
}
