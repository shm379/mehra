<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WalletHistoryStatus extends Enum
{
    const CREDIT = 1;
    const DEBIT = 2;
}
