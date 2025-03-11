<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class PaymentSessionAttempt extends Dto
{
    public function __construct(
        public ?PaymentMethod $paymentMethod = null,
    ) {}
}
