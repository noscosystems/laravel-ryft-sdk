<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;

readonly class SubscriptionPaymentSessions extends Dto
{
    public function __construct(
        public ?SubscriptionPaymentSession $initial = null,
        public ?SubscriptionPaymentSession $latest = null,
    ) {}
}
