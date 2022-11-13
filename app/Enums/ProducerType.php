<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static PUBLISHER()
 * @method static static BRAND()
 * @method static static PRODUCER()
 */
final class ProducerType extends Enum implements LocalizedEnum
{
    const PUBLISHER = 1;
    const BRAND = 2;
    const PRODUCER = 3;
}
