<?php

namespace Nosco\Ryft\Dtos\Payments;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Support\Helpers;

class SplitPaymentDetail extends Dto
{
    /**
     * @param Collection<SplitPaymentItem>|null $items
     */
    public function __construct(
        public ?Collection $items = null
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'items' => SplitPaymentItem::multipleFromArray($data->get('items')),
        ]);

        return parent::fromArray($data);
    }
}
