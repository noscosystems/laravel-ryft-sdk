<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class ValueAmount extends Dto
{
    public function __construct(public ?int $amount = null) {}
}
