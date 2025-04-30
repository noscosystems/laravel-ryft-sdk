<?php

namespace Nosco\Ryft\Dtos\PlatformFees;

use DateTimeInterface;
use Nosco\Ryft\Dto;

readonly class PlatformFee extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $paymentSessionId = null,
        public ?int $amount = null,
        public ?int $paymentAmount = null,
        public ?int $processingFee = null,
        public ?int $netAmount = null,
        public ?string $currency = null,
        public ?string $fromAccountId = null,
        public ?DateTimeInterface $createdTimestamp = null,
    ) {}
}
