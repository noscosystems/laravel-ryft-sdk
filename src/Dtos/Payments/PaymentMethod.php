<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

readonly class PaymentMethod extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $cvc = null,
        public ?string $type = null,
        public ?TokenizedDetails $tokenizedDetails = null,
        public ?Card $card = null,
        public ?Wallet $wallet = null,
        public ?CustomerAddress $billingAddress = null,
        public ?CardChecks $checks = null,
    ) {}
}
