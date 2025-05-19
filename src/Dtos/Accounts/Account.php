<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\AccountEntityType;
use Nosco\Ryft\Enums\Accounts\AccountOnboardingFlow;
use Nosco\Ryft\Enums\Accounts\AccountStatus;
use Nosco\Ryft\Enums\Accounts\AccountType;
use Nosco\Ryft\Support\Helpers;

class Account extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?AccountType $type = null,
        public ?AccountStatus $status = null,
        public ?Collection $actionsRequired = null,
        public ?bool $frozen = null,
        public ?AccountOnboardingFlow $onboardingFlow = null,
        public ?string $email = null,
        public ?AccountEntityType $entityType = null,
        public ?Business $business = null,
        public ?Individual $individual = null,
        public ?AccountVerification $verification = null,
        public ?Collection $metadata = null,
        public ?AccountSettings $settings = null,
        public ?TermsOfService $termsOfService = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'actionsRequired' => RequiredAction::multipleFromArray($data->get('actionsRequired', [])),
        ]);

        return parent::fromArray($data);
    }

    public function ryftSubAccountId(): ?string
    {
        return $this->id;
    }
}
