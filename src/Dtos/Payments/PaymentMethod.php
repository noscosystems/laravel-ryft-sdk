<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\PaymentMethods\Card;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethodChecks;
use Nosco\Ryft\Dtos\PaymentMethods\Wallet;

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
        public ?PaymentMethodChecks $checks = null,
    ) {}
}
