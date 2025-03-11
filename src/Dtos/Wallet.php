<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\WalletType;

readonly class Wallet extends Dto
{
    public function __construct(
        public ?WalletType $type = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'type' => WalletType::tryFrom($data->get('type', '')),
        ]);

        return parent::fromArray($data);
    }
}
