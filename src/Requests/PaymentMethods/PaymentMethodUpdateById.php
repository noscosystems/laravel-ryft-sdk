<?php

namespace Nosco\Ryft\Requests\PaymentMethods;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentMethodUpdateById.
 *
 * This is used to update an existing payment method
 */
class PaymentMethodUpdateById extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/payment-methods/{$this->paymentMethodId}";
    }

    /**
     * @param string $paymentMethodId Payment Method to update
     */
    public function __construct(
        protected string $paymentMethodId,
    ) {}
}
