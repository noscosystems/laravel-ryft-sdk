<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Payments\ReturnsPaymentSession;
use Saloon\Enums\Method;

/**
 * paymentSessionGet.
 *
 * This is used to fetch a payment session by its paymentSessionId
 */
class PaymentSessionGet extends Request
{
    use ReturnsPaymentSession;

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
