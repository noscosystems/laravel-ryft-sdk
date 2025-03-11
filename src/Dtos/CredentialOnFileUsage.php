<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Initiator;
use Nosco\Ryft\Enums\Sequence;

readonly class CredentialOnFileUsage extends Dto
{
    public function __construct(
        public ?Initiator $initiator = null,
        public ?Sequence $sequence = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'initiator' => Initiator::tryFrom($data->get('initiator', '')),
            'sequence' => Sequence::tryFrom($data->get('sequence', '')),
        ]);

        return parent::fromArray($data);
    }
}
