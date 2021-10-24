<?php

declare(strict_types=1);

namespace App\PricingEngine;

class Duration
{
    /** @var int */
    public $durationInMinutes;

    public function __construct(int $durationInMinutes)
    {
        $this->durationInMinutes = $durationInMinutes;
    }

    public static function fromMinutes(int $minutes): self
    {
        return new self($minutes);
    }
}
