<?php

namespace Nosco\Ryft\Traits\Requests\Disputes;

use Nosco\Ryft\Dtos\Disputes\Dispute;
use Saloon\Http\Response;

trait ReturnsDispute
{
    public function createDtoFromResponse(Response $response): ?Dispute
    {
        return Dispute::fromResponse($response);
    }
}
