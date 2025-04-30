<?php

namespace Nosco\Ryft\Dtos\Persons;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Accounts\RequiredDocument;
use Nosco\Ryft\Dtos\Accounts\RequiredField;
use Nosco\Ryft\Dtos\Accounts\VerificationError;
use Nosco\Ryft\Enums\Accounts\VerificationStatus;
use Nosco\Ryft\Support\Helpers;

readonly class PersonVerification extends Dto
{
    /**
     * @param Collection<RequiredField>|null     $requiredFields
     * @param Collection<RequiredDocument>|null  $requiredDocuments
     * @param Collection<VerificationError>|null $errors
     */
    public function __construct(
        public ?VerificationStatus $status = null,
        public ?Collection $requiredFields = null,
        public ?Collection $requiredDocuments = null,
        public ?Collection $errors = null,
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
