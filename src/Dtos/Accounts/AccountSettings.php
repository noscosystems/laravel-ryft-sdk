<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

class AccountSettings extends Dto
{
    public function __construct(
        public ?AccountPayouts $payouts = null,
    ) {}
}
