<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

readonly class AccountSettings extends Dto
{
    public function __construct(
        public ?AccountPayouts $payouts = null,
    ) {}
}
