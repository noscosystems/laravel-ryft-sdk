<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use DateTimeInterface;
use Nosco\Ryft\Dto;

readonly class CancelledPaymentDetails extends Dto
{
    public function __construct(
        public ?string $reason = null,
        public ?DateTimeInterface $cancelledAtTimestamp = null,
    ) {}
}
