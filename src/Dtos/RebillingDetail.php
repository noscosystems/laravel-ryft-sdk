<?php

namespace Nosco\Ryft\Dtos;

use DateTimeInterface;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Support\Helpers;

readonly class RebillingDetail extends Dto
{
    public function __construct(
        public ?string $amountVariance = null,
        public ?int $numberOfDaysBetweenPayments = null,
        public ?int $totalNumberOfPayments = null,
        public ?int $currentPaymentNumber = null,
        public ?DateTimeInterface $expiry = null,
    ) {}

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $properties['expiry'] = Helpers::timestamp($this?->expiry);

        return array_filter($properties);
    }
}
