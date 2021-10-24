<?php

declare(strict_types=1);

namespace App\Money;

use MyCLabs\Enum\Enum;

/**
 * @method static static EUR()
 * @method static static USD()
 */
class Currency extends Enum
{
    private const EUR = 'EUR';
    private const USD = 'USD';
}
