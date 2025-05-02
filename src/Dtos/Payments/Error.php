<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Stringable;

class Error extends Dto implements Stringable
{
    public function __construct(
        public ?string $code = null,
        public ?string $message = null,
    ) {}

    public function __toString(): string
    {
        return $this->message ?? '';
    }
}
