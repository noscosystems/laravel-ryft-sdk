<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Nosco\Ryft\Dto;

readonly class Acceptance extends Dto
{
    public function __construct(
        public ?string $ip = null,
        public ?string $userAgent = null,
        public ?DateTimeInterface $date = null,
    ) {}
}
