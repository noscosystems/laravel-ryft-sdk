<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use DateTimeInterface;
use Nosco\Ryft\Dto;

class BillingDetails extends Dto
{
    public function __construct(
        public ?int $totalCycles = null,
        public ?int $currentCycle = null,
        public ?DateTimeInterface $currentCycleStartTimestamp = null,
        public ?DateTimeInterface $currentCycleEndTimestamp = null,
        public ?DateTimeInterface $billingCycleTimestamp = null,
        public ?DateTimeInterface $nextBillingTimestamp = null,
        public ?BillingFailureDetails $failureDetail = null,
    ) {}
}
