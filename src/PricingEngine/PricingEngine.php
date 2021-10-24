<?php

declare(strict_types=1);

namespace App\PricingEngine;

use App\Money\Money;

class PricingEngine
{
    /** @var Money */
    public $pricePerMinute;

    /** @var Duration */
    public $duration;

    public function __construct(Money $pricePerMinute, Duration $duration)
    {
        $this->pricePerMinute = $pricePerMinute;
        $this->duration = $duration;
    }

    public function calculatePrice(): Money
    {
        return $this->pricePerMinute->multiplyAndRound($this->duration->durationInMinutes);
    }
}
