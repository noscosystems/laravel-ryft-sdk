<?php

namespace Nosco\Ryft\Dtos\PayoutMethods;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Accounts\AccountAddress;
use Nosco\Ryft\Enums\PayoutMethods\BankAccountNumberType;
use Nosco\Ryft\Enums\PayoutMethods\BankIdType;

class BankAccount extends Dto
{
    public function __construct(
        public ?BankIdType $bankIdType = null,
        public ?string $bankId = null,
        public ?string $bankName = null,
        public ?BankAccountNumberType $accountNumberType = null,
        public ?string $accountNumber = null,
        public ?string $last4 = null,
        public ?AccountAddress $address = null,
    ) {}
}
