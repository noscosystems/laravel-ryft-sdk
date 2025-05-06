<?php

namespace Nosco\Ryft\Dtos\PaymentMethods;

use DateTimeInterface;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Payments\CustomerAddress;
use Nosco\Ryft\Dtos\Payments\TokenizedDetails;
use Nosco\Ryft\Enums\PaymentMethods\PaymentMethodType;

class PaymentMethod extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?PaymentMethodType $type = null,
        public ?PaymentMethod $paymentMethod = null,
        public ?Card $card = null,
        public ?Wallet $wallet = null,
        public ?CustomerAddress $billingAddress = null,
        public ?PaymentMethodChecks $checks = null,
        public ?string $customerId = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?string $cvc = null,
        public ?TokenizedDetails $tokenizedDetails = null,
    ) {}
}
