<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class StatementDescriptor extends Dto
{
    public function __construct(
        public ?string $descriptor = null,
        public ?string $city = null,
    ) {}
}
