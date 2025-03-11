<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\RequiredActionType;

readonly class RequiredAction extends Dto
{
    public function __construct(
        public ?RequiredActionType $type = null,
        public ?string $url = null,
        public ?RequiredActionIdentify $identify = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'type' => RequiredActionType::tryFrom($data->get('type', '')),
            'identify' => RequiredActionIdentify::fromArray($data->get('identify', '')),
        ]);

        return parent::fromArray($data);
    }
}
