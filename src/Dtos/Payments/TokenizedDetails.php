<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class TokenizedDetails extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $token = null,
        public ?bool $stored = null,
    ) {}
}
