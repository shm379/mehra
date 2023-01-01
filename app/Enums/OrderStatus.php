<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static CART()
 * @method static static PENDING()
 * @method static static CANCELED()
 * @method static static RETURNED()
 * @method static static COMPLETED()
 */
final class OrderStatus extends Enum implements LocalizedEnum
{
    const CART = 0;
    const PENDING = 1;
    const CANCELED = 2;
    const RETURNED = 3;
    const COMPLETED = 4;
}


