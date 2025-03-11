<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class ShippingDetails extends Dto
{
    public function __construct(
        public ?CustomerAddress $address = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'address' => CustomerAddress::fromArray($data->get('address')),
        ]);

        return parent::fromArray($data);
    }
}
