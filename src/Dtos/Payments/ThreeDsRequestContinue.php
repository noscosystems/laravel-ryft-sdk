<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class ThreeDsRequestContinue extends Dto
{
    public function __construct(
        public ?string $fingerprint = null,
        public ?string $challengeResult = null,
    ) {}
}
