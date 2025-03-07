<?php

namespace Nosco\Ryft\Requests\AccountLinks;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
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

    public function __construct() {}
}
