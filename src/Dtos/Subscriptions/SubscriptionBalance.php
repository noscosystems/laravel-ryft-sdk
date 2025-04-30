<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;

readonly class SubscriptionBalance extends Dto
{
    public function __construct(
        public ?int $amount = null,
    ) {}
}
