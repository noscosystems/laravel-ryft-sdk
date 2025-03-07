<?php

namespace Nosco\Ryft\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * customerGetPaymentMethods.
 *
 * This is used to fetch a customer's payment methods
 */
class CustomerGetPaymentMethods extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/customers/{$this->customerId}/payment-methods";
    }

    /**
     * @param string $customerId Customer whose payment methods to retrieve
     */
    public function __construct(
        protected string $customerId,
    ) {}
}
