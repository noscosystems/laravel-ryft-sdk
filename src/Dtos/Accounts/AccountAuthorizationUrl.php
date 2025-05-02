<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Nosco\Ryft\Dto;

class AccountAuthorizationUrl extends Dto
{
    public function __construct(
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $expiresTimestamp = null,
        public ?string $url = null,
    ) {}
}
