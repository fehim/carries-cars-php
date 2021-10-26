<?php

declare(strict_types=1);

namespace App\PricingEngine;

use App\Booking\Duration;
use App\Booking\Reservation;
use App\Money\Currencies;
use App\Money\Money;
use PHPUnit\Framework\TestCase;

class PricingEngineTest extends TestCase
{
    /**
     * @dataProvider dpCalculatePriceChargedPerMinute
     */
    public function testCalculatePriceChargedPerMinute(
        Money $pickupSurchargePerMinute,
        Money $mileageSurchargePerKm,
        Money $pricePerMinute,
        Reservation $reservation,
        Money $totalPrice
    ): void {
        //var_dump($reservation);
        $actual = (new PricingEngine($pickupSurchargePerMinute, $mileageSurchargePerKm, $pricePerMinute, $reservation))->calculatePrice();

        self::assertTrue($actual->equalTo($totalPrice));
    }

    public function dpCalculatePriceChargedPerMinute(): array
    {
        return [
            // pickupSurchargePerMinute, mileageSurchargePerKm, pricePerMinute, reservation, totalPrice
            [Currencies::EUR(2), Currencies::EUR(1), Currencies::EUR(30), new Reservation(Duration::fromMinutes(5), Duration::fromMinutes(1)), Currencies::EUR(30)],
            [Currencies::EUR(8), Currencies::EUR(2), Currencies::EUR(30), new Reservation(Duration::fromMinutes(20), Duration::fromMinutes(3)), Currencies::EUR(90)],
            [Currencies::EUR(6), Currencies::EUR(3), Currencies::EUR(23), new Reservation(Duration::fromMinutes(18), Duration::fromMinutes(12)), Currencies::EUR(276)],
            [Currencies::EUR(9), Currencies::EUR(4), Currencies::EUR(24), new Reservation(Duration::fromMinutes(25), Duration::fromMinutes(32)), Currencies::EUR(813)],
            [Currencies::EUR(9), Currencies::EUR(19), Currencies::EUR(24), new Reservation(Duration::fromMinutes(25), Duration::fromMinutes(32), 300), Currencies::EUR(1763)],
        ];
    }
}
