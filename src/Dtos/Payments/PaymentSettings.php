<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

readonly class PaymentSettings extends Dto
{
    public function __construct(
        public ?PaymentMethodOptions $paymentMethodOptions = null,
    ) {}
}
