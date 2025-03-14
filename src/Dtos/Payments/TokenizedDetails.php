<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

readonly class TokenizedDetails extends Dto
{
    public function __construct(
        public ?string $token = null,
        public ?bool $stored = null,
    ) {}
}
