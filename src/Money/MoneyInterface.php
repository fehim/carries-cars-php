<?php

declare(strict_types=1);

namespace App\Money;

interface MoneyInterface
{
    public function equalTo(Money $money): bool;

    public function multiplyAndRound(float $by): Money;
}
