<?php

namespace Nosco\Ryft\Traits\Requests\PaymentMethods;

use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Saloon\Http\Response;

trait ReturnsPaymentMethod
{
    public function createDtoFromResponse(Response $response): ?PaymentMethod
    {
        return PaymentMethod::fromResponse($response);
    }
}
