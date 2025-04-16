<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\BusinessType;

readonly class Business extends Dto
{
    /**
     * @param Collection<string>|null $tradingCountries
     */
    public function __construct(
        public ?string $name = null,
        public ?BusinessType $type = null,
        public ?string $registrationNumber = null,
        public ?DateTimeInterface $registrationDate = null,
        public ?AccountAddress $registeredAddress = null,
        public ?string $contactEmail = null,
        public ?string $phoneNumber = null,
        public ?string $tradingName = null,
        public ?AccountAddress $tradingAddress = null,
        public ?Collection $tradingCountries = null,
        public ?string $websiteUrl = null,
    ) {}
}
