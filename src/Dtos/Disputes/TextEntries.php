<?php

namespace Nosco\Ryft\Dtos\Disputes;

use Nosco\Ryft\Dto;

readonly class TextEntries extends Dto
{
    public function __construct(
        public ?string $billingAddress = null,
        public ?string $shippingAddress = null,
        public ?string $duplicateTransaction = null,
        public ?string $uncategorised = null,
    ) {}
}
