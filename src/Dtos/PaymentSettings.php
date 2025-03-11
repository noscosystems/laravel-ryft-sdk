<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class PaymentSettings extends Dto
{
    public function __construct(
        public ?PaymentMethodOptions $paymentMethodOptions = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'paymentMethodOptions' => PaymentMethodOptions::fromArray($data->get('paymentMethodOptions')),
        ]);

        return parent::fromArray($data);
    }
}
