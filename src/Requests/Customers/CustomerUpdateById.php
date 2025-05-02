<?php

namespace Nosco\Ryft\Requests\Customers;

use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Customers\ReturnsCustomer;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * customerUpdateById.
 *
 * This is used to update an existing customer
 */
class CustomerUpdateById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsCustomer;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/customers/{$this->customerId}";
    }

    /**
     * @param string $customerId Customer to update
     */
    public function __construct(
        protected string $customerId,
        protected Customer $customer,
    ) {}

    protected function defaultBody(): array
    {
        return $this->customer->toArray();
    }
}
