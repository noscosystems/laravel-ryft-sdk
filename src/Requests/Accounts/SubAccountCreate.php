<?php

namespace Nosco\Ryft\Requests\Accounts;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subAccountCreate.
 *
 * This is for registering new users onto your platform that will act as one of your 'sub' accounts
 */
class SubAccountCreate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/accounts';
    }

    public function __construct() {}
}
