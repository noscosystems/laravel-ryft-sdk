<?php

namespace Nosco\Ryft\Dtos\ApplePay;

use Nosco\Ryft\Dto;

class ApplePaySession extends Dto
{
    public function __construct(
        public ?string $sessionObject = null,
    ) {}
}
