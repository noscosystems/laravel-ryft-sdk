<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class TokenizedDetails extends Dto
{
    public function __construct(
        public ?string $token = null,
        public ?bool $stored = null,
    ) {}
}
