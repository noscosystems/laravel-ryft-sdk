<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class RequiredActionChallenge extends Dto
{
    public function __construct(
        public ?string $acsUrl = null,
        public ?string $cReq = null,
    ) {}
}
