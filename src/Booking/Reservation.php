<?php

declare(strict_types=1);

namespace App\Booking;

class Reservation
{
    public const SURCHARGE_PICKUP_LIMIT = 20;

    public const SURCHARGE_MILEAGE_LIMIT = 250;

    public Duration $duration;

    public Duration $pickedUpAfter;

    public int $mileage = 0;

    public function __construct(Duration $pickedUpAfter, Duration $duration, int $mileage = null)
    {
        $this->pickedUpAfter = $pickedUpAfter;
        $this->duration      = $duration;
        $this->mileage       = $mileage;
    }
}
