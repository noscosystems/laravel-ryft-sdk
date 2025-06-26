<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Subscriptions\RecurringIntervalUnit;

class RecurringInterval extends Dto
{
    public function __construct(
        public ?RecurringIntervalUnit $unit = null,
        public ?int $count = null,
        public ?int $times = null,
    ) {}
}
