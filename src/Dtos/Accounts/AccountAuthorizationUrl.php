<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;

class AccountAuthorizationUrl
{
    public function __construct(
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $expiresTimestamp = null,
        public ?string $url = null,
    ) {}
}
