<?php

declare(strict_types=1);

namespace App\Booking;

class Reservation
{
    public const SURCHARGE_PICKUP_LIMIT = 20;

    public Duration $duration;

    public Duration $pickedUpAfter;

    public function __construct(Duration $pickedUpAfter, Duration $duration)
    {
        $this->pickedUpAfter = $pickedUpAfter;
        $this->duration      = $duration;
    }
}
