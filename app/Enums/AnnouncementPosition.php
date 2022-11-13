<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AnnouncementPosition extends Enum
{
    const EVERYWHERE = 1;
    const HOME = 2;
    const PAGES = 3;
    const PRODUCTS = 4;
    const CATEGORIES = 5;
    const COMMENTS = 6;
}
