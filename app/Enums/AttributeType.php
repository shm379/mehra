<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static MULTI_CHOICE()
 * @method static static SINGLE_CHOICE()
 * @method static static YES_OR_NO()
 * @method static static NUMBER()
 * @method static static COLOR()
 * @method static static TEXTAREA()
 * @method static static INPUT()
 * @method static static WEIGHT()
 * @method static static DIMENSIONS()
 */
final class AttributeType extends Enum implements LocalizedEnum
{
    const MULTI_CHOICE = 1;
    const SINGLE_CHOICE = 2;
    const YES_OR_NO = 3;
    const NUMBER = 4;
    const COLOR = 5;
    const TEXTAREA = 6;
    const INPUT = 7;
    const WEIGHT = 8;
    const DIMENSIONS = 9;
}
