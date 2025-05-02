<?php

namespace Nosco\Ryft\Dtos\Events;

use Nosco\Ryft\Dto;

class EventEndpoint extends Dto
{
    public function __construct(
        public ?string $webhookId = null,
        public ?bool $acknowledged = null,
        public ?int $attempts = null,
    ) {}
}
