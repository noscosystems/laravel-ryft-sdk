<?php

namespace Nosco\Ryft\Dtos\Accounts;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\AccountEntityType;
use Nosco\Ryft\Enums\Accounts\AccountOnboardingFlow;
use Nosco\Ryft\Enums\AccountStatus;
use Nosco\Ryft\Support\Helpers;

readonly class Account extends Dto
{
    public function __construct(
        public ?string $id,
        public ?AccountStatus $status,
        public ?Collection $actionsRequired,
        public ?bool $frozen,
        public ?AccountOnboardingFlow $onboardingFlow,
        public ?string $email = null,
        public ?AccountEntityType $entityType = null,
        public ?Business $business = null,
        public ?Individual $individual = null,
        public ?AccountVerification $verification = null,
        public ?Collection $metadata = null,
        public ?AccountSettings $settings = null,
        public ?TermsOfService $termsOfService = null,
        public ?DateTimeInterface $createdTimestamp = null,
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
}
