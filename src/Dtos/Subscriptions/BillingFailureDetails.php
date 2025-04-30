<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Payments\PaymentError;

readonly class BillingFailureDetails extends Dto
{
    public function __construct(
        public ?int $paymentAttempts = null,
        public ?PaymentError $lastPaymentError = null,
    ) {}
}
