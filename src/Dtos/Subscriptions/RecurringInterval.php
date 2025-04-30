<?php

namespace Nosco\Ryft\Dtos\Subscriptions;

use Nosco\Ryft\Dto;

readonly class RecurringInterval extends Dto
{
    public function __construct(
        public ?string $unit = null,
        public ?int $count = null,
        public ?int $times = null,
    ) {}
}
