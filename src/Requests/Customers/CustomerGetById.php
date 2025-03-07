<?php

namespace Nosco\Ryft\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * customerGetById.
 *
 * This is used to fetch a customer by its unique Id
 */
class CustomerGetById extends Request
{
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
