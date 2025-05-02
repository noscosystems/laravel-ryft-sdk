<?php

namespace Nosco\Ryft\Traits\Requests\Accounts;

use Nosco\Ryft\Dtos\Accounts\Account;
use Saloon\Http\Response;

trait ReturnsAccount
{
    public function createDtoFromResponse(Response $response): ?Account
    {
        return Account::fromResponse($response);
    }
}
