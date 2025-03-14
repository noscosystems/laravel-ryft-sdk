<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class PaymentSessionContinue extends Dto
{
    public function __construct(
        public ?string $clientSecret = null,

    ) {}
}
