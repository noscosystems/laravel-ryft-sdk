<?php

namespace Nosco\Ryft\Dtos\Disputes;

use DateTimeInterface;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Accounts\Account;
use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Dtos\Payments\PaymentSession;
use Nosco\Ryft\Enums\Disputes\DisputeCategory;
use Nosco\Ryft\Enums\Disputes\DisputeStatus;
use Nosco\Ryft\Enums\Disputes\EvidenceType;

readonly class Dispute extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?int $amount = null,
        public ?string $currency = null,
        public ?DisputeStatus $status = null,
        public ?DisputeCategory $category = null,
        public ?DisputeReason $reason = null,
        public ?DateTimeInterface $respondBy = null,
        public ?EvidenceType $recommendedEvidence = null,
        public ?PaymentSession $paymentSession = null,
        public ?DisputeEvidence $evidence = null,
        public ?Customer $customer = null,
        public ?Account $subAccount = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}
}
