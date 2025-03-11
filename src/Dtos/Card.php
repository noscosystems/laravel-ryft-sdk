<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\CardScheme;

readonly class Card extends Dto
{
    public function __construct(
        public ?CardScheme $scheme = null,
        public ?string $last4 = null,
    ) {}
}
