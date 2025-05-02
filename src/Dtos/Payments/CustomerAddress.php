<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class CustomerAddress extends Dto
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $lineOne = null,
        public ?string $lineTwo = null,
        public ?string $city = null,
        public ?string $country = null,
        public ?string $postalCode = null,
        public ?string $region = null,
    ) {}
}
