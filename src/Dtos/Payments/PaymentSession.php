<?php

namespace Nosco\Ryft\Dtos\Payments;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Nosco\Ryft\Enums\Payments\AuthorizationType;
use Nosco\Ryft\Enums\Payments\CaptureFlow;
use Nosco\Ryft\Enums\Payments\EntryMode;
use Nosco\Ryft\Enums\Payments\PaymentError;
use Nosco\Ryft\Enums\Payments\PaymentStatus;
use Nosco\Ryft\Enums\Payments\PaymentType;

class PaymentSession extends Dto
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
