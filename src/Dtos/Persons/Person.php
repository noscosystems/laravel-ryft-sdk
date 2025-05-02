<?php

namespace Nosco\Ryft\Dtos\Persons;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Accounts\AccountAddress;
use Nosco\Ryft\Dtos\Accounts\AccountDocument;
use Nosco\Ryft\Enums\Gender;
use Nosco\Ryft\Support\Helpers;

class Person extends Dto
{
    /**
     * @param Collection<string>|null          $nationalities
     * @param Collection<AccountDocument>|null $documents
     */
    public function __construct(
        public ?string $id = null,
        public ?string $firstName = null,
        public ?string $middleNames = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?DateTimeInterface $dateOfBirth = null,
        public ?string $countryOfBirth = null,
        public ?Gender $gender = null,
        public ?Collection $nationalities = null,
        public ?AccountAddress $address = null,
        public ?string $phoneNumber = null,
        public ?Collection $businessRoles = null,
        public ?PersonVerification $verification = null,
        public ?Collection $documents = null,
        public ?Collection $metadata = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'documents' => AccountDocument::multipleFromArray($data->get('documents', [])),
        ]);

        return parent::fromArray($data);
    }
}
