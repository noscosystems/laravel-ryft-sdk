<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\CapabilityStatus;
use Nosco\Ryft\Support\Helpers;

readonly class AccountCapability extends Dto
{
    /**
     * @param Collection<RequiredField>|null $requiredFields
     */
    public function __construct(
        public ?CapabilityStatus $status = null,
        public ?bool $requested = null,
        public ?Collection $requiredFields = null,
        public ?string $disabledReason = null,
        public ?DateTimeInterface $requestedTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'requiredFields' => RequiredField::multipleFromArray($data->get('requiredFields', [])),
        ]);

        return parent::fromArray($data);
    }
}
