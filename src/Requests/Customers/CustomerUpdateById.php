<?php

namespace Nosco\Ryft\Requests\Customers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * customerUpdateById.
 *
 * This is used to update an existing customer
 */
class CustomerUpdateById extends Request implements HasBody
{
    use HasJsonBody;

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
    ) {}
}
