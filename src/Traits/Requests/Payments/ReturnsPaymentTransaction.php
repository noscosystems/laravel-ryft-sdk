<?php

namespace Nosco\Ryft\Traits\Requests\Payments;

use Nosco\Ryft\Dtos\Payments\PaymentTransaction;
use Saloon\Http\Response;

trait ReturnsPaymentTransaction
{
    public function createDtoFromResponse(Response $response): ?PaymentTransaction
    {
        return PaymentTransaction::fromResponse($response);
    }
}
