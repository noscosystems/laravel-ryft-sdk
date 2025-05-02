<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\VerificationStatus;
use Nosco\Ryft\Support\Helpers;

class AccountPersons extends Dto
{
    /**
     * @param Collection<RequiredRole>|null $required
     */
    public function __construct(
        public ?VerificationStatus $status = null,
        public ?Collection $required = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'required' => RequiredRole::multipleFromArray($data->get('required', [])),
        ]);

        return parent::fromArray($data);
    }
}
