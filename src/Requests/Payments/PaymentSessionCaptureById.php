<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\Payments\PaymentTransaction;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Payments\ReturnsPaymentTransaction;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentSessionCaptureById.
 *
 * Call this endpoint to capture funds you have previously authorized on a payment session.
 * You can
 * only call this endpoint when the payment session is in status `Approved` and its `captureFlow` value
 * is `Manual`.
 */
class PaymentSessionCaptureById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsPaymentTransaction;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/payment-sessions/{$this->paymentSessionId}/captures";
    }

    /**
     * @param string $paymentSessionId Payment Id to update
     */
    public function __construct(
        protected string $paymentSessionId,
        protected PaymentTransaction $paymentTransaction,
    ) {}

    protected function defaultBody(): array
    {
        return $this->paymentTransaction->toArray();
    }
}
