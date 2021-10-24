<?php

declare(strict_types=1);

namespace App\Money;

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testEqualToDetectsIdenticalValues(): void
    {
        $ninetyNineEuroCents = Currencies::EUR(99);
        $alsoNinetyNineEuroCents = Currencies::EUR(99);

        self::assertTrue($ninetyNineEuroCents->equalTo($alsoNinetyNineEuroCents));
    }

    public function testEqualToDetectsDifferenceOfCurrencies(): void
    {
        $ninetyNineEuroCents = Currencies::EUR(99);
        $ninetyNineDollarCents = Currencies::USD(99);

        self::assertFalse($ninetyNineEuroCents->equalTo($ninetyNineDollarCents));
    }

    public function testEqualToDetectsDifferenceInAmount(): void
    {
        $ninetyNineEuroCents = Currencies::EUR(99);
        $fortyTwoCents = Currencies::USD(42);

        self::assertFalse($ninetyNineEuroCents->equalTo($fortyTwoCents));
    }

    /**
     * @dataProvider dpMultiplyAndRoundWorksAsExpected
     */
    public function testMultiplyAndRoundWorksAsExpected(Money $baseAmount, float $multiplier, Money $multipliedAmount): void
    {
        $actual = $baseAmount->multiplyAndRound($multiplier);

        self::assertTrue($actual->equalTo($multipliedAmount));
    }

    public function dpMultiplyAndRoundWorksAsExpected(): array
    {
        return [
            [Currencies::EUR(33), 3, Currencies::EUR(99)],
            [Currencies::EUR(30), 3.33, Currencies::EUR(100)],
            [Currencies::EUR(10), 0.24, Currencies::EUR(2)],
        ];
    }
}
