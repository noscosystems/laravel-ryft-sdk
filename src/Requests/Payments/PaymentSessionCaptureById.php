<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\PaymentSession;
use Nosco\Ryft\Dtos\PaymentTransaction;
use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Response;
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
        protected PaymentTransaction $paymentSession,
    ) {}

    public function createDtoFromResponse(Response $response): ?PaymentTransaction
    {
        return PaymentTransaction::fromResponse($response);
    }
}
