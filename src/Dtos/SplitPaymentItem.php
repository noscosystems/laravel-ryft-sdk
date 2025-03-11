<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class SplitPaymentItem extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $accountId = null,
        public ?int $amount = null,
        public ?string $description = null,
        public ?ValueAmount $fee = null,
        public ?array $metadata = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'fee' => ValueAmount::fromArray($data->get('fee')),
        ]);

        return parent::fromArray($data);
    }
}
