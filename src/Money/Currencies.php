<?php

declare(strict_types=1);

namespace App\Money;

class Currencies
{
    public static function EUR(int $amountInCents): Money
    {
        return new Money($amountInCents, Currency::EUR());
    }

    public static function USD(int $amountInCents): Money
    {
        return new Money($amountInCents, Currency::USD());
    }
}
