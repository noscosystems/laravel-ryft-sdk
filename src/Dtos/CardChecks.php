<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\AvsResponseCode;
use Nosco\Ryft\Enums\CvvResponseCode;

readonly class CardChecks extends Dto
{
    public function __construct(
        public ?AvsResponseCode $avsResponseCode = null,
        public ?CvvResponseCode $cvvResponseCode = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'avsResponseCode' => AvsResponseCode::tryFrom($data->get('avsResponseCode', '')),
            'cvvResponseCode' => CvvResponseCode::tryFrom($data->get('cvvResponseCode', '')),
        ]);

        return parent::fromArray($data);
    }
}
