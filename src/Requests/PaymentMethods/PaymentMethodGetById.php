<?php

namespace Nosco\Ryft\Requests\PaymentMethods;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * paymentMethodGetById.
 *
 * This is used to fetch a payment method by its unique Id
 */
class PaymentMethodGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/payment-methods/{$this->paymentMethodId}";
    }

    /**
     * @param string $paymentMethodId Payment Method to retrieve
     */
    public function __construct(
        protected string $paymentMethodId,
    ) {}
}
