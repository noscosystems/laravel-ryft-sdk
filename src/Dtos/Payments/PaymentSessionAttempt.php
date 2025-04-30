<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\PaymentMethods\Card;
use Nosco\Ryft\Dtos\PaymentMethods\Wallet;

readonly class PaymentSessionAttempt extends Dto
{
    public function __construct(
        public ?string $clientSecret = null,
        public ?string $paymentMethodType = null,
        public ?Card $cardDetails = null,
        public ?Wallet $walletDetails = null,
        public ?PaymentMethod $paymentMethod = null,
        public ?PaymentMethodOptions $paymentMethodOptions = null,
        public ?CustomerAddress $billingAddress = null,
        public ?CustomerDetails $customerDetails = null,
        public ?ThreeDsRequestDetails $threeDsRequestDetails = null,
    ) {}
}
