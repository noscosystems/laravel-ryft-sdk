<?php

namespace Nosco\Ryft\Dtos\PaymentMethods;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

class PaymentMethodOptions extends Dto
{
    /**
     * @param Collection<string>|null $disabled
     */
    public function __construct(
        public ?Collection $disabled = null,
        public ?bool $store = null,
    ) {}
}
