<?php

declare(strict_types=1);

namespace App\PricingEngine;

use App\Booking\Reservation;
use App\Money\Money;

class PricingEngine
{
    public Money $pickupSurchargePerMinute;

    public Money $mileageSurchargePerKm;

    public Money $pricePerMinute;

    public Reservation $reservation;

    public function __construct(
        Money       $pickupSurchargePerMinute,
        Money       $mileageSurchargePerKm,
        Money       $pricePerMinute,
        Reservation $reservation
    )
    {
        $this->pickupSurchargePerMinute = $pickupSurchargePerMinute;
        $this->mileageSurchargePerKm    = $mileageSurchargePerKm;
        $this->pricePerMinute           = $pricePerMinute;
        $this->reservation              = $reservation;
    }

    public function calculatePrice(): Money
    {
        $totalPrice    = $this->pricePerMinute->multiplyAndRound($this->reservation->duration->durationInMinutes);
        $pickedUpAfter = $this->reservation->pickedUpAfter;

        if ($pickedUpAfter->durationInMinutes > Reservation::SURCHARGE_PICKUP_LIMIT) {
            // Calculate surcharge since customer couldn't make it on time
            $reservationSurcharge = $this->pickupSurchargePerMinute->multiplyAndRound(
                $pickedUpAfter->durationInMinutes - Reservation::SURCHARGE_PICKUP_LIMIT
            );

            $totalPrice = $totalPrice->add($reservationSurcharge);
        }

        $mileage = $this->reservation->mileage;

        if ($mileage && $mileage > Reservation::SURCHARGE_MILEAGE_LIMIT) {
            $mileageSurcharge = $this->mileageSurchargePerKm->multiplyAndRound(
                $this->reservation->mileage - Reservation::SURCHARGE_MILEAGE_LIMIT
            );

            $totalPrice = $totalPrice->add($mileageSurcharge);
        }

        return $totalPrice;
    }

    public static function calculatePriceWithPackage(): Money
    {

    }
}
