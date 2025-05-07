<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Nosco\Ryft\Dtos\Payments\PaymentSettings;
use Nosco\Ryft\Dtos\Payments\ShippingDetails;
use Nosco\Ryft\Enums\Subscriptions\SubscriptionStatus;

class Subscription extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?RecurringPrice $price = null,
        public ?PaymentMethod $paymentMethod = null,
        public ?string $description = null,
        public ?DateTimeInterface $billingCycleTimestamp = null,
        public ?Collection $metadata = null,
        public ?ShippingDetails $shippingDetails = null,
        public ?PaymentSettings $paymentSettings = null,
        public ?SubscriptionStatus $status = null,
        public ?Customer $customer = null,
        public ?SubscriptionPaymentSessions $paymentSessions = null,
        public ?SubscriptionBalance $balance = null,
        public ?PausedPaymentDetails $pausedPaymentDetail = null,
        public ?CancelledPaymentDetails $cancelDetail = null,
        public ?BillingDetails $billingDetail = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}
}
