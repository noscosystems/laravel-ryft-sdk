<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\VerificationErrorCode;

readonly class VerificationError extends Dto
{
    public function __construct(
        public ?VerificationErrorCode $code = null,
        public ?string $id = null,
        public ?string $description = null,
    ) {}
}
