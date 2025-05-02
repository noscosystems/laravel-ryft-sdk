<?php

namespace Nosco\Ryft\Dtos\PayoutMethods;

use DateTimeInterface;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\PayoutMethods\PayoutMethodStatus;
use Nosco\Ryft\Enums\PayoutMethods\PayoutMethodType;

class PayoutMethod extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?PayoutMethodType $type = null,
        public ?string $displayName = null,
        public ?PayoutMethodStatus $status = null,
        public ?string $invalidReason = null,
        public ?string $currency = null,
        public ?string $country = null,
        public ?BankAccount $bankAccount = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}
}
