<?php

namespace Nosco\Ryft\Requests\Customers;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * customerCreate.
 *
 * This is for creating customers within your Ryft account (to enable features such as saved payment
 * methods)
 */
class CustomerCreate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/customers';
    }

    public function __construct() {}
}
