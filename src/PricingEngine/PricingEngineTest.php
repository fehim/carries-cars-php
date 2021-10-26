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
        $actual = (new PricingEngine($pickupSurchargePerMinute, $mileageSurchargePerKm, $pricePerMinute, $reservation))->calculatePrice();

        self::assertTrue($actual->equalTo($totalPrice));
    }

    /**
     * @dataProvider dpPackageRatesAreChargedWithinLimits
     */
    public function testPackageRatesAreChargedWithinLimits(Reservation $reservation, array $calculatedPrices): void
    {
        $packages = [
            [3, 75, 19],
            [6, 125, 39],
            [24, 200, 59],
            [168, 700, 209]
        ];

        foreach ($packages as $key => $package) {
            $totalPrice = PricingEngine::calculatePriceWithPackage($package, $reservation);

            self::assertTrue($totalPrice->equalTo($calculatedPrices[$key]));
        }
    }

    public function dpPackageRatesAreChargedWithinLimits(): array
    {
        return [
            // reservation, prices array
            [
                new Reservation(Duration::fromMinutes(15), Duration::fromMinutes(180), 75),
                [
                    Currencies::EUR(1900),
                    Currencies::EUR(3900),
                    Currencies::EUR(5900),
                    Currencies::EUR(20900),
                ],
            ],
            [
                new Reservation(Duration::fromMinutes(15), Duration::fromMinutes(240), 100),
                [
                    Currencies::EUR(2500),
                    Currencies::EUR(3900),
                    Currencies::EUR(5900),
                    Currencies::EUR(20900),
                ]
            ],
        ];
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
