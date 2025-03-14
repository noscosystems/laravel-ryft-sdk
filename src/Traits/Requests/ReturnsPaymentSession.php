<?php

namespace Nosco\Ryft\Traits\Requests;

use Nosco\Ryft\Dtos\Payments\PaymentSession;
use Saloon\Http\Response;

trait ReturnsPaymentSession
{
    public function createDtoFromResponse(Response $response): ?PaymentSession
    {
        return PaymentSession::fromResponse($response);
    }
}
