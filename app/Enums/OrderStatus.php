<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const PENDING = 1;
    const CANCELED = 2;
    const RETURNED = 3;
    const COMPLETED = 4;
}
