<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

readonly class AccountCapabilities extends Dto
{
    public function __construct(
        public ?AccountCapability $visaPayments = null,
        public ?AccountCapability $mastercardPayments = null,
        public ?AccountCapability $amexPayments = null,
    ) {}
}
