<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class OrderDetails extends Dto
{
    /**
     * @param OrderLineItem[]|null $items
     */
    public function __construct(
        public ?array $items = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'items' => collect($data->get('items'))
                ->map(fn (array $item): OrderLineItem => OrderLineItem::fromArray($item))
                ->all(),
        ]);

        return parent::fromArray($data);
    }
}
