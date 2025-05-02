<?php

namespace Nosco\Ryft\Requests\Customers;

use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Customers\ReturnsCustomer;
use Saloon\Enums\Method;

/**
 * customerDeleteById.
 *
 * This is used to delete a customer by its unique Id
 */
class CustomerDeleteById extends Request
{
    use ReturnsCustomer;

    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/customers/{$this->customerId}";
    }

    /**
     * @param string $customerId Customer to delete
     */
    public function __construct(
        protected string $customerId,
    ) {}
}
