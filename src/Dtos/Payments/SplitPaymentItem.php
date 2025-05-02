<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class SplitPaymentItem extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $accountId = null,
        public ?int $amount = null,
        public ?string $description = null,
        public ?ValueAmount $fee = null,
        public ?array $metadata = null,
    ) {}
}
