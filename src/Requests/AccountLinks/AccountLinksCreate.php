<?php

namespace Nosco\Ryft\Requests\AccountLinks;

use Nosco\Ryft\Dtos\Accounts\AccountAuthorizationUrl;
use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * accountLinksCreate.
 *
 * Generate a temporary account link to redirect the user to, in order for them to complete
 * registration and payout setup via our portal
 */
class AccountLinksCreate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/account-links';
    }

    public function __construct(
        protected string $accountId,
        protected string $redirectUrl,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'accountId' => $this->accountId,
            'redirectUrl' => $this->redirectUrl,
        ];
    }

    public function createDtoFromResponse(Response $response): AccountAuthorizationUrl
    {
        return AccountAuthorizationUrl::fromResponse($response);
    }
}
