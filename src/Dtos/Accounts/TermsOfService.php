<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

readonly class TermsOfService extends Dto
{
    public function __construct(
        public ?Acceptance $acceptance = null,
    ) {}
}
