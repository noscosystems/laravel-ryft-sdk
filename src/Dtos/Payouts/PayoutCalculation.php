<?php

namespace Nosco\Ryft\Dtos\Payouts;

use Nosco\Ryft\Dto;

class PayoutCalculation extends Dto
{
    public function __construct(
        public ?int $paymentsCapturedAmount = null,
        public ?int $paymentsRefundedAmount = null,
        public ?int $paymentsSplitAmount = null,
        public ?int $paymentsSplitRefundedAmount = null,
        public ?int $splitPaymentsAmount = null,
        public ?int $splitPaymentsRefundedAmount = null,
        public ?int $platformFeesCollectedAmount = null,
        public ?int $platformFeesRefundedAmount = null,
        public ?int $platformFeesPaidAmount = null,
        public ?int $processingFeesPaidAmount = null,
        public ?int $chargebacksAmount = null,
        public ?int $chargebackReversalsAmount = null,
        public ?int $platformChargebacksAmount = null,
        public ?int $platformChargebackReversalsAmount = null,
        public ?int $transferredInAmount = null,
        public ?int $transferredOutAmount = null,
        public ?int $payoutAmount = null,
        public ?string $currency = null,
        public ?int $numberOfPaymentsCaptured = null,
        public ?int $numberOfPaymentsRefunded = null,
        public ?int $numberOfPaymentsSplit = null,
        public ?int $numberOfPaymentsSplitRefunded = null,
        public ?int $numberOfSplitPayments = null,
        public ?int $numberOfSplitPaymentsRefunded = null,
        public ?int $numberOfPlatformFeesCollected = null,
        public ?int $numberOfPlatformFeesRefunded = null,
        public ?int $numberOfChargebacks = null,
        public ?int $numberOfChargebackReversals = null,
        public ?int $numberOfPlatformChargebacks = null,
        public ?int $numberOfPlatformChargebackReversals = null,
        public ?int $numberOfTransfersIn = null,
        public ?int $numberOfTransfersOut = null,
        public ?int $numberOfCustomers = null,
        public ?int $numberOfNewCustomers = null,
    ) {}
}
