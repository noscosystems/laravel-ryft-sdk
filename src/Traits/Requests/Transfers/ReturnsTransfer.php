<?php

namespace Nosco\Ryft\Traits\Requests\Transfers;

use Nosco\Ryft\Dtos\Transfers\Transfer;

trait ReturnsTransfer
{
    public function createDtoFromResponse(Response $response): ?Transfer
    {
        return Transfer::fromResponse($response);
    }
}
