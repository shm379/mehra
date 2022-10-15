<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderNoteStatus extends Enum
{
    const SUCCESS = 'SUCCESS';
    const FAILURE = 'FAILURE';
}
