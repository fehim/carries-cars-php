<?php

declare(strict_types=1);

namespace App\PricingEngine;

use App\Money\Currencies;
use App\Money\Money;
use PHPUnit\Framework\TestCase;

class PricingEngineTest extends TestCase
{
    /**
     * @dataProvider dpCalculatePriceChargedPerMinute
     */
    public function testCalculatePriceChargedPerMinute(Money $pricePerMinute, Duration $duration, Money $totalPrice): void
    {
        $actual = (new PricingEngine($pricePerMinute, $duration))->calculatePrice();

        self::assertTrue($actual->equalTo($totalPrice));
    }

    public function dpCalculatePriceChargedPerMinute(): array
    {
        return [
            [Currencies::EUR(30), Duration::fromMinutes(1), Currencies::EUR(30)],
            [Currencies::EUR(30), Duration::fromMinutes(3), Currencies::EUR(90)],
            [Currencies::EUR(23), Duration::fromMinutes(12), Currencies::EUR(276)],
        ];
    }
}
