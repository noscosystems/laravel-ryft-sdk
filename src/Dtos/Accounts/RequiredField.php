<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

class RequiredField extends Dto
{
    public function __construct(
        public ?string $name = null,
    ) {}
}
