<?php

namespace Nosco\Ryft\Traits\Requests\Customers;

use Nosco\Ryft\Dtos\Customers\Customer;
use Saloon\Http\Response;

trait ReturnsCustomer
{
    public function createDtoFromResponse(Response $response): ?Customer
    {
        return Customer::fromResponse($response);
    }
}
