<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use DateTimeInterface;
use Nosco\Ryft\Dto;

readonly class PausedPaymentDetails extends Dto
{
    public function __construct(
        public ?string $reason = null,
        public ?DateTimeInterface $resumeAtTimestamp = null,
        public ?DateTimeInterface $pausedAtTimestamp = null,
    ) {}
}
