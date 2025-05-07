<?php

namespace Nosco\Ryft\Dtos\Customers;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

class Customer extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $email = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $homePhoneNumber = null,
        public ?string $mobilePhoneNumber = null,
        public ?Collection $metadata = null,
        public ?string $defaultPaymentMethod = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}
}
