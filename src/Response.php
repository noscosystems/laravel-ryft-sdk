<?php

namespace Nosco\Ryft;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Payments\Error;
use Saloon\Http\Response as SaloonResponse;

class Response extends SaloonResponse
{
    /**
     * @return Collection<Error>
     */
    public function errors(): Collection
    {
        return $this->collect('errors')
            ->map(fn (array $error): Error => Error::fromArray($error));
    }

    public function id(): ?string
    {
        return $this->json('requestId');
    }
}
