<?php

namespace Nosco\Ryft\Dtos\Disputes;

use Nosco\Ryft\Dto;

readonly class DisputeReason extends Dto
{
    public function __construct(
        public ?string $code = null,
        public ?string $description = null,
    ) {}
}
