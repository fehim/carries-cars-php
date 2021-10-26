<?php

declare(strict_types=1);

namespace App\Money;

class Money implements MoneyInterface
{
    /** @var Currency */
    public $currency;

    /** @var int */
    public $amountInCents;

    public function __construct(int $amountInCents, Currency $currency)
    {
        $this->amountInCents = $amountInCents;
        $this->currency      = $currency;
    }

    public function equalTo(Money $money): bool
    {
        return $money->amountInCents === $this->amountInCents && $money->currency->equals($this->currency);
    }

    public function multiplyAndRound(float $by): Money
    {
        return new self((int)round($this->amountInCents * $by), $this->currency);
    }

    public function add(Money $money): Money
    {
        return new self($this->amountInCents + $money->amountInCents, $this->currency);
    }
}
