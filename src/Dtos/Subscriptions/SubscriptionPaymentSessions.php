<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;

class SubscriptionPaymentSessions extends Dto
{
    public function __construct(
        public ?SubscriptionPaymentSession $initial = null,
        public ?SubscriptionPaymentSession $latest = null,
    ) {}
}
