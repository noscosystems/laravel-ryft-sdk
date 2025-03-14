<?php

namespace Nosco\Ryft\Dtos;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\AuthorizationType;
use Nosco\Ryft\Enums\CaptureFlow;
use Nosco\Ryft\Enums\EntryMode;
use Nosco\Ryft\Enums\PaymentError;
use Nosco\Ryft\Enums\PaymentStatus;
use Nosco\Ryft\Enums\PaymentType;

readonly class PaymentSession extends Dto
{
    /**
     * @param Collection<string>|null $enabledPaymentMethods
     * @param Collection<string>|null $metadata
     */
    public function __construct(
        public ?int $amount = null,
        public ?PaymentSessionAttempt $attemptPayment = null,
        public ?AuthorizationType $authorizationType = null,
        public ?CaptureFlow $captureFlow = null,
        public ?string $clientSecret = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?CredentialOnFileUsage $credentialOnFileUsage = null,
        public ?string $currency = null,
        public ?CustomerDetails $customerDetails = null,
        public ?string $customerEmail = null,
        public ?Collection $enabledPaymentMethods = null,
        public ?EntryMode $entryMode = null,
        public ?string $id = null,
        public ?PaymentError $lastError = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
        public ?Collection $metadata = null,
        public ?OrderDetails $orderDetails = null,
        public ?bool $passThroughProcessingFee = null,
        public ?PaymentMethod $paymentMethod = null,
        public ?PaymentSettings $paymentSettings = null,
        public ?PaymentType $paymentType = null,
        public ?int $platformFee = null,
        public ?PaymentSession $previousPayment = null,
        public ?RebillingDetail $rebillingDetail = null,
        public ?int $refundedAmount = null,
        public ?RequiredAction $requiredAction = null,
        public ?string $returnUrl = null,
        public ?ShippingDetails $shippingDetails = null,
        public ?SplitPaymentDetail $splits = null,
        public ?StatementDescriptor $statementDescriptor = null,
        public ?PaymentStatus $status = null,
        public ?bool $verifyAccount = null,
    ) {}
}
