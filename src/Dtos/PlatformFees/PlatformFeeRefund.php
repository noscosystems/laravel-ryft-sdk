<?php

namespace Nosco\Ryft\Dtos\PlatformFees;

use DateTimeInterface;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\PlatformFees\PlatformFeeRefundStatus;

readonly class PlatformFeeRefund extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $platformFeeId = null,
        public ?int $amount = null,
        public ?string $currency = null,
        public ?string $reason = null,
        public ?PlatformFeeRefundStatus $status = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}
}
