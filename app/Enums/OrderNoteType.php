<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderNoteType extends Enum
{
    const SYSTEM = 'SYSTEM';
    const ADMIN = 'ADMIN';
}
