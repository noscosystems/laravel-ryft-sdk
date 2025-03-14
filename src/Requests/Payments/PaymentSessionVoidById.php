<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\PaymentTransaction;
use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentSessionVoidById.
 *
 * Call this endpoint to void a payment session currently awaiting manual capture.
 * This will reverse
 * the amount authorized on the payment and return it to the customer. If voided on the same-day, the
 * transaction will not show up on the customer's card statement(s).
 * You can only call this endpoint
 * when the payment session is in status `Approved` and its `captureFlow` value is `Manual`.
 */
class PaymentSessionVoidById extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/payment-sessions/{$this->paymentSessionId}/voids";
    }

    /**
     * @param string $paymentSessionId Payment Id to void
     */
    public function __construct(
        protected string $paymentSessionId,
    ) {}

    public function createDtoFromResponse(Response $response): ?PaymentTransaction
    {
        return PaymentTransaction::fromResponse($response);
    }
}
