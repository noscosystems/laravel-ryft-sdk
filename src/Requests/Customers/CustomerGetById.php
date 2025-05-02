<?php

namespace Nosco\Ryft\Requests\Customers;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Customers\ReturnsCustomer;
use Saloon\Enums\Method;

/**
 * customerGetById.
 *
 * This is used to fetch a customer by its unique Id
 */
class CustomerGetById extends Request
{
    use ReturnsCustomer;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/customers/{$this->customerId}";
    }

    /**
     * @param string $customerId Customer to retrieve
     */
    public function __construct(
        protected string $customerId,
    ) {}
}
