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
        public ?array $enabledPaymentMethods = null,
        public ?EntryMode $entryMode = null,
        public ?string $id = null,
        public ?PaymentError $lastError = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
        public ?array $metadata = null,
        public ?OrderDetails $orderDetails = null,
        public ?bool $passThroughProcessingFee = null,
        public ?PaymentMethod $paymentMethod = null,
        public ?PaymentSettings $paymentSettings = null,
        public ?PaymentType $paymentType = null,
        public ?int $platformFee = null,
        public ?self $previousPayment = null,
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

    public static function fromArray(Collection|array|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'attemptPayment' => PaymentSessionAttempt::fromArray($data->get('attemptPayment')),
            'authorizationType' => AuthorizationType::tryFrom($data->get('authorizationType', '')),
            'captureFlow' => CaptureFlow::tryFrom($data->get('captureFlow', '')),
            'createdTimestamp' => static::dateTime($data->get('createdTimestamp')),
            'credentialOnFileUsage' => CredentialOnFileUsage::fromArray($data->get('credentialOnFileUsage')),
            'customerDetails' => CustomerDetails::fromArray($data->get('customerDetails')),
            'entryMode' => EntryMode::tryFrom($data->get('entryMode', '')),
            'lastError' => PaymentError::tryFromWithFallback($data->get('lastError', '')),
            'lastUpdatedTimestamp' => static::dateTime($data->get('lastUpdatedTimestamp')),
            'orderDetails' => OrderDetails::fromArray($data->get('orderDetails')),
            'paymentMethod' => PaymentMethod::fromArray($data->get('paymentMethod')),
            'paymentSettings' => PaymentSettings::fromArray($data->get('paymentSettings')),
            'paymentType' => PaymentType::tryFrom($data->get('paymentType', '')),
            'previousPayment' => static::fromArray($data->get('previousPayment')),
            'rebillingDetail' => RebillingDetail::fromArray($data->get('rebillingDetail')),
            'requiredAction' => RequiredAction::fromArray($data->get('requiredAction')),
            'shippingDetails' => ShippingDetails::fromArray($data->get('shippingDetails')),
            'splits' => SplitPaymentDetail::fromArray($data->get('splits')),
            'statementDescriptor' => StatementDescriptor::fromArray($data->get('statementDescriptor')),
            'status' => PaymentStatus::tryFrom($data->get('status', '')),
        ]);

        return parent::fromArray($data);
    }
}
