<?php

namespace Nosco\Ryft\Requests\Accounts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * subAccountGetById.
 *
 * This is used to fetch details for one of your sub accounts.
 */
class SubAccountGetById extends Request
{
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
