<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

class AccountPayouts extends Dto
{
    public function __construct(
        public ?AccountPayoutSchedule $schedule = null,
    ) {}
}
