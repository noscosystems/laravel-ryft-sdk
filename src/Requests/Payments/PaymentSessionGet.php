<?php

namespace Nosco\Ryft\Requests\Payments;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * paymentSessionGet.
 *
 * This is used to fetch a payment session by its paymentSessionId
 */
class PaymentSessionGet extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/payment-sessions/{$this->paymentSessionId}";
    }

    /**
     * @param string $paymentSessionId Payment Id to retrieve
     */
    public function __construct(
        protected string $paymentSessionId,
    ) {}
}
