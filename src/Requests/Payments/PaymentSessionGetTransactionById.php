<?php

namespace Nosco\Ryft\Requests\Payments;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * paymentSessionGetTransactionById.
 *
 * Retrieve the transaction for a particular payment
 */
class PaymentSessionGetTransactionById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/payment-sessions/{$this->paymentSessionId}/transactions/{$this->paymentTransactionId}";
    }

    /**
     * @param string $paymentSessionId     Payment Id that the transaction is under
     * @param string $paymentTransactionId Payment transaction Id to retrieve
     */
    public function __construct(
        protected string $paymentSessionId,
        protected string $paymentTransactionId,
    ) {}
}
