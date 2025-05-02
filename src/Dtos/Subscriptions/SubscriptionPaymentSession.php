<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Payments\RequiredAction;

class SubscriptionPaymentSession extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $clientSecret = null,
        public ?RequiredAction $requiredAction = null,
    ) {}
}
