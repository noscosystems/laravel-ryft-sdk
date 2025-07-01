<?php

namespace Nosco\Ryft;

use Nosco\Ryft\Traits\HasCursorPagination;
use Nosco\Ryft\Traits\HasResources;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\PaginationPlugin\Contracts\HasPagination;

class RyftConnector extends Connector implements HasPagination
{
    use HasCursorPagination;
    use HasResources;

    protected ?string $response = Response::class;

    public function resolveBaseUrl(): string
    {
        return $this->sandboxed()
            ? $this->sandboxBaseUrl()
            : $this->productionBaseUrl();
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new TokenAuthenticator($this->secretKey(), prefix: '');
    }

    protected function sandboxed(): bool
    {
        return config('ryft.sandbox', false);
    }

    protected function productionBaseUrl(): string
    {
        return 'https://api.ryftpay.com/v1';
    }

    protected function sandboxBaseUrl(): string
    {
        return 'https://sandbox-api.ryftpay.com/v1';
    }

    protected function secretKey(): string
    {
        return config('ryft.auth.secret', '');
    }

    public function connector(): RyftConnector
    {
        return $this;
    }
}
