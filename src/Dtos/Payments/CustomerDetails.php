<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class CustomerDetails extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $homePhoneNumber = null,
        public ?string $mobilePhoneNumber = null,
        public ?array $metadata = null,
    ) {}
}
