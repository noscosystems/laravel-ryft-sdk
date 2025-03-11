<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;

readonly class OrderLineItem extends Dto
{
    public function __construct(
        public ?string $reference = null,
        public ?string $name = null,
        public ?int $quantity = null,
        public ?int $unitPrice = null,
        public ?int $taxAmount = null,
        public ?int $totalAmount = null,
        public ?int $discountAmount = null,
        public ?string $productUrl = null,
        public ?string $imageUrl = null,
    ) {}
}
