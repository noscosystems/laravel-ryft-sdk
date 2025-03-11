<?php

namespace Nosco\Ryft\Requests\Accounts;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subAccountAuthorize.
 *
 * We recommend calling this endpoint first when you onboard your users to cater for those that may
 * already have Ryft accounts.
 * If the email supplied is not registered with Ryft then you should
 * instead use our account-links API to register a new user.
 * This API can only be accessed for `Hosted`
 * sub accounts.
 */
class SubAccountAuthorize extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/accounts/authorize';
    }

    public function __construct() {}
}
