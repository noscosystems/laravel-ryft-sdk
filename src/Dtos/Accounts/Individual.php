<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Gender;

readonly class Individual extends Dto
{
    /**
     * @param Collection<string>|null $nationalities
     */
    public function __construct(
        public ?string $firstName,
        public ?string $middleNames,
        public ?string $lastName,
        public ?string $email,
        public ?DateTimeInterface $dateOfBirth,
        public ?string $countryOfBirth,
        public ?Gender $gender,
        public ?Collection $nationalities,
        public ?AccountAddress $address,
        public ?string $phoneNumber = null,
    ) {}
}
