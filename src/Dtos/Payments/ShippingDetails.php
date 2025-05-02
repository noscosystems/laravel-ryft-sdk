<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class ShippingDetails extends Dto
{
    public function __construct(
        public ?CustomerAddress $address = null,
    ) {}
}
