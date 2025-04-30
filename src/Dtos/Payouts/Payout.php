<?php

namespace Nosco\Ryft\Dtos\Payouts;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Nosco\Ryft\Enums\Payouts\AccountPayoutStatus;
use Nosco\Ryft\Enums\Payouts\PayoutScheme;
use Nosco\Ryft\Enums\Payouts\ScheduleType;

readonly class Payout extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?int $amount = null,
        public ?string $currency = null,
        public ?string $payoutMethodId = null,
        public ?Collection $metadata = null,
        public ?DateTimeInterface $paymentsTakenDate = null,
        public ?DateTimeInterface $paymentsTakenDateFrom = null,
        public ?DateTimeInterface $paymentsTakenDateTo = null,
        public ?AccountPayoutStatus $status = null,
        public ?ScheduleType $scheduleType = null,
        public ?PayoutMethod $payoutMethod = null,
        public ?string $failureReason = null,
        public ?PayoutCalculation $payoutCalculation = null,
        public ?PayoutScheme $scheme = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $scheduledTimestamp = null,
        public ?DateTimeInterface $completedTimestamp = null,
    ) {}
}
