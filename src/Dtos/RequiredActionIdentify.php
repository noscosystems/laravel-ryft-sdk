<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class RequiredActionIdentify extends Dto
{
    public function __construct(
        public ?string $uniqueId = null,
        public ?string $threeDsMethodUrl = null,
        public ?string $threeDsMethodSignature = null,
        public ?string $threeDsMethodData = null,
        public ?string $sessionId = null,
        public ?string $sessionSecret = null,
        public ?string $scheme = null,
        public ?string $paymentMethodId = null,
    ) {}
}
