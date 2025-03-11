<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class ShippingDetails extends Dto
{
    public function __construct(
        public ?CustomerAddress $address = null,
    ) {}
}
