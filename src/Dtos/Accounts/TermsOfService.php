<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

class TermsOfService extends Dto
{
    public function __construct(
        public ?Acceptance $acceptance = null,
    ) {}
}
