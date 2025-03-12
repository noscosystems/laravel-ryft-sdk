<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;
use Stringable;

readonly class Error extends Dto implements Stringable
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
