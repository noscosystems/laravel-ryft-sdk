<?php

namespace Nosco\Ryft\Traits\Requests\Accounts;

use Nosco\Ryft\Dtos\Payouts\Payout;
use Nosco\Ryft\Response;

trait ReturnsPayout
{
    public function createDtoFromResponse(Response $response): ?Payout
    {
        return Payout::fromResponse($response);
    }
}
