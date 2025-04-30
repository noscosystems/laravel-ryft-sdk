<?php

namespace Nosco\Ryft\Dtos\Transfers;

use Nosco\Ryft\Dto;

readonly class TransferError extends Dto
{
    public function __construct(
        public ?string $code = null,
        public ?string $description = null,
    ) {}
}
