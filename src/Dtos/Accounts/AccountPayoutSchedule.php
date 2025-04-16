<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Payouts\ScheduleType;

readonly class AccountPayoutSchedule extends Dto
{
    public function __construct(
        public ?ScheduleType $type = null,
    ) {}
}
