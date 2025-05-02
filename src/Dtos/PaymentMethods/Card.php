<?php

namespace Nosco\Ryft\Dtos\PaymentMethods;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Payments\CardScheme;

class Card extends Dto
{
    public function __construct(
        public ?string $cvc = null,
        public ?string $expiryMonth = null,
        public ?string $expiryYear = null,
        public ?string $last4 = null,
        public ?string $name = null,
        public ?string $number = null,
        public ?CardScheme $scheme = null,
    ) {}
}
