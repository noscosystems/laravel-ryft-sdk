<?php

namespace Nosco\Ryft\Traits\Requests;

use Saloon\Traits\RequestProperties\HasHeaders;

trait HasAccountHeader
{
    use HasHeaders;

    public function withAccount(string $accountId): self
    {
        $this->headers()->add($this->accountHeaderName(), $accountId);

        return $this;
    }

    public function accountHeaderName(): string
    {
        return 'Account';
    }
}
