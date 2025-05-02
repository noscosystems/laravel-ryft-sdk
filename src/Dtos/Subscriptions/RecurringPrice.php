<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;

class RecurringPrice extends Dto
{
    public function __construct(
        public ?int $amount = null,
        public ?string $currency = null,
        public ?RecurringInterval $interval = null,
    ) {}
}
