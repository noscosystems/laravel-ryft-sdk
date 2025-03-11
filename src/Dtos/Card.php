<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\CardScheme;

readonly class Card extends Dto
{
    public function __construct(
        public ?CardScheme $scheme = null,
        public ?string $last4 = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'scheme' => CardScheme::tryFrom($data->get('scheme', '')),
        ]);

        return parent::fromArray($data);
    }
}
