<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class PaymentSettings extends Dto
{
    public function __construct(
        public ?PaymentMethodOptions $paymentMethodOptions = null,
        public ?StatementDescriptor $statementDescriptor = null,
    ) {}
}
