<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AttributeType extends Enum
{
    const MULTI_CHOICE = 'چند انتخابی';
    const SINGLE_CHOICE = 'تک انتخابی';
    const YES_OR_NO = 'بله یا خیر';
    const NUMBER = 'شماره';
    const COLOR = 'رنگ';
    const TEXTAREA = 'متن طولانی';
    const INPUT = 'متن';
    const WEIGHT = 'وزن';
    const DIMENSIONS = 'ابعاد';
}
