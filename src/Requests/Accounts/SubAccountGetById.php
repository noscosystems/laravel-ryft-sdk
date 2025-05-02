<?php

namespace Nosco\Ryft\Requests\Accounts;

use Nosco\Ryft\Dtos\Accounts\Account;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Accounts\ReturnsAccount;
use Saloon\Enums\Method;

/**
 * subAccountGetById.
 *
 * This is used to fetch details for one of your sub accounts.
 */
class SubAccountGetById extends Request
{
    use ReturnsAccount;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}";
    }

    /**
     * @param string $id the account id of one of your sub accounts
     */
    public function __construct(
        protected string $id,
    ) {}
}
