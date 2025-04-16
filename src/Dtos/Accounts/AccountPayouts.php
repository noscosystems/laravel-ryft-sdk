<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

readonly class AccountPayouts extends Dto
{
    public function __construct(
        public ?AccountPayoutSchedule $schedule = null,
    ) {}
}
