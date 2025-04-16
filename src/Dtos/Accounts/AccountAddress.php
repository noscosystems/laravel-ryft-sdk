<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;

readonly class AccountAddress extends Dto
{
    public function __construct(
        public ?string $lineOne = null,
        public ?string $lineTwo = null,
        public ?string $city = null,
        public ?string $country = null,
        public ?string $postalCode = null,
        public ?string $region = null,
    ) {}
}
