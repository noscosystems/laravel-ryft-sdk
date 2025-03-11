<?php

namespace Nosco\Ryft\Requests\Accounts;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subAccountUpdate.
 *
 * This is used to update the details of one of your sub accounts. This API can only be accessed for
 * `NonHosted` sub accounts.
 */
class SubAccountUpdate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

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
