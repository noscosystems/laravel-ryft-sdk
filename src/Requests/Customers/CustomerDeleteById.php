<?php

namespace Nosco\Ryft\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * customerDeleteById.
 *
 * This is used to delete a customer by its unique Id
 */
class CustomerDeleteById extends Request
{
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
