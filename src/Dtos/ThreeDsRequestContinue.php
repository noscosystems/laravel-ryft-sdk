<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class ThreeDsRequestContinue extends Dto
{
    public function __construct(
        public ?string $fingerprint = null,
        public ?string $challengeResult = null,
    ) {}
}
