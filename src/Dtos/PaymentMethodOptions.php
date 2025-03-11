<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class PaymentMethodOptions extends Dto
{
    public function __construct(
        public ?array $disabled = null,
    ) {}
}
