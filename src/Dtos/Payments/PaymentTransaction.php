<?php

namespace Nosco\Ryft\Dtos\Payments;

use DateTimeInterface;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Nosco\Ryft\Enums\Payments\CaptureType;
use Nosco\Ryft\Enums\Payments\TransactionStatus;
use Nosco\Ryft\Enums\Payments\TransactionType;

class PaymentTransaction extends Dto
{
    public function __construct(
        public ?int $amount = null,
        public ?PaymentTransaction $captureTransaction = null,
        public ?CaptureType $captureType = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?string $currency = null,
        public ?string $id = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
        public ?PaymentMethod $paymentMethod = null,
        public ?string $paymentSessionId = null,
        public ?int $platformFee = null,
        public ?int $platformFeeRefundedAmount = null,
        public ?int $processingFee = null,
        public ?string $reason = null,
        public ?int $refundedAmount = null,
        public ?SplitPaymentDetail $splitPaymentDetail = null,
        public ?SplitPaymentDetail $splits = null,
        public ?TransactionStatus $status = null,
        public ?TransactionType $type = null,
    ) {}
}
