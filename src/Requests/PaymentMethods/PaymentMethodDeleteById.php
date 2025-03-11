<?php

namespace Nosco\Ryft\Requests\PaymentMethods;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * paymentMethodDeleteById.
 *
 * This is used to delete a payment method by instead. Note that you can only delete payment-methods
 * that aren't single-use. For example you can delete a customer's saved payment method, but you cannot
 * delete a token generated for one-time purchases
 */
class PaymentMethodDeleteById extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/payment-methods/{$this->paymentMethodId}";
    }

    /**
     * @param string $paymentMethodId Payment Method to delete
     */
    public function __construct(
        protected string $paymentMethodId,
    ) {}
}
