<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethodOptions;

class PaymentSettings extends Dto
{
    public function __construct(
        public ?PaymentMethodOptions $paymentMethodOptions = null,
        public ?StatementDescriptor $statementDescriptor = null,
    ) {}
}
