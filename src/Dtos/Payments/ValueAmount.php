<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class ValueAmount extends Dto
{
    public function __construct(public ?int $amount = null) {}
}
