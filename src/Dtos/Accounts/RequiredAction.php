<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\AccountAction;

class RequiredAction extends Dto
{
    public function __construct(
        public ?AccountAction $action = null,
        public ?string $description = null,
    ) {}
}
