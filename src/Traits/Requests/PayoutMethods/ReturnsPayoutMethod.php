<?php

namespace Nosco\Ryft\Traits\Requests\PayoutMethods;

use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Saloon\Http\Response;

trait ReturnsPayoutMethod
{
    public function createDtoFromResponse(Response $response): ?PayoutMethod
    {
        return PayoutMethod::fromResponse($response);
    }
}
