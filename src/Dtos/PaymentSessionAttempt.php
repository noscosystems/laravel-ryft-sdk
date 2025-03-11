<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class PaymentSessionAttempt extends Dto
{
    public function __construct(
        public ?PaymentMethod $paymentMethod = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        return new static(
            paymentMethod: PaymentMethod::fromArray($data->get('paymentMethod')),
        );
    }
}
