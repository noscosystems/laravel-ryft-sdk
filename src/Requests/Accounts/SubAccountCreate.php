<?php

namespace Nosco\Ryft\Requests\Accounts;

use Nosco\Ryft\Dtos\Accounts\Account;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Accounts\ReturnsAccount;
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
    use ReturnsAccount;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/accounts';
    }

    public function __construct(protected Account $account) {}

    protected function defaultBody(): array
    {
        return $this->account->toArray();
    }
}
