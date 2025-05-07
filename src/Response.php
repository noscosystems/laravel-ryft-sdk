<?php

namespace Nosco\Ryft;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Error;
use Saloon\Http\Response as SaloonResponse;

class Response extends SaloonResponse
{
    /**
     * @return Collection<Error>
     */
    public function errors(): Collection
    {
        return Error::fromPaginatedResponse($this);
    }

    public function id(): ?string
    {
        return $this->json('requestId');
    }
}
