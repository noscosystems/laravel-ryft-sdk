<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\PaymentTransaction;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;

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

    public function createDtoFromResponse(Response $response): ?PaymentTransaction
    {
        return PaymentTransaction::fromResponse($response);
    }
}
