<?php

namespace Nosco\Ryft\Dtos\ApplePay;

use DateTimeInterface;
use Nosco\Ryft\Dto;

class ApplePayWebDomain extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $domainName = null,
        public ?DateTimeInterface $createdTimestamp = null,
    ) {}
}
