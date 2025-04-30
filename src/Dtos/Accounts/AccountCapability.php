<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\CapabilityStatus;

readonly class AccountCapability extends Dto
{
    public function __construct(
        public ?CapabilityStatus $status = null,
        public ?bool $requested = null,
        public ?Collection $requiredFields = null,
        public ?string $disabledReason = null,
        public ?DateTimeInterface $requestedTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}
}
