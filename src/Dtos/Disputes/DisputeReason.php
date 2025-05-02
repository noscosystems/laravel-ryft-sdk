<?php

namespace Nosco\Ryft\Dtos\Disputes;

use Nosco\Ryft\Dto;

class DisputeReason extends Dto
{
    public function __construct(
        public ?string $code = null,
        public ?string $description = null,
    ) {}
}
