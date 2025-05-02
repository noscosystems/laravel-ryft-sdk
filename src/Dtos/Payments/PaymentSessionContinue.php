<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class PaymentSessionContinue extends Dto
{
    public function __construct(
        public ?string $clientSecret = null,

    ) {}
}
