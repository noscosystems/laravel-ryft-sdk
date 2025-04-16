<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Persons\BusinessRole;

readonly class RequiredRole extends Dto
{
    public function __construct(
        public ?BusinessRole $role = null,
        public ?int $quantity = null,
    ) {}
}
