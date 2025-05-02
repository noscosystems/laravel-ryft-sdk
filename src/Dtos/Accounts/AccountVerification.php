<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\VerificationStatus;
use Nosco\Ryft\Support\Helpers;

class AccountVerification extends Dto
{
    /**
     * @param Collection<RequiredField>|null    $requiredFields
     * @param Collection<RequiredDocument>|null $requiredDocuments
     */
    public function __construct(
        public ?VerificationStatus $status = null,
        public ?Collection $requiredFields = null,
        public ?Collection $requiredDocuments = null,
        public ?Collection $errors = null,
        public ?AccountPersons $persons = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'requiredFields' => RequiredField::multipleFromArray($data->get('requiredFields', [])),
            'requiredDocuments' => RequiredDocument::multipleFromArray($data->get('requiredDocuments', [])),
            'errors' => VerificationError::multipleFromArray($data->get('errors', [])),
        ]);

        return parent::fromArray($data);
    }
}
