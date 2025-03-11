<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class OrderDetails extends Dto
{
    /**
     * @param Collection<OrderLineItem>|null $items
     */
    public function __construct(
        public ?Collection $items = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'items' => OrderLineItem::multipleFromArray($data->get('items')),
        ]);

        return parent::fromArray($data);
    }
}
