<?php

namespace Nosco\Ryft\Dtos\Events;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Nosco\Ryft\Dtos\Payments\CustomerDetails;
use Nosco\Ryft\Dtos\Subscriptions\PausedPaymentDetails;

class EventData extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $accountId = null,
        public ?string $paymentTransactionId = null,
        public ?int $amount = null,
        public ?int $platformFee = null,
        public ?string $currency = null,
        public ?Collection $metaData = null,
        public ?string $email = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $defaultPaymentMethod = null,
        public ?CustomerDetails $customer = null,
        public ?PaymentMethod $paymentMethod = null,
        public ?PausedPaymentDetails $pausePaymentDetail = null,
        public ?string $type = null,
        public ?string $status = null,
    ) {}
}
