<?php

namespace Nosco\Ryft\Requests\Accounts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subAccountVerify.
 *
 * Once you have created all Persons and satisfied all the verification requirements for them and the
 * Business, you submit these details for verification. This endpoint cannot be accessed for
 * `Individual` sub accounts as this process is done automatically after satisfying the verification
 * requirements.
 */
class SubAccountVerify extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/verify";
    }

    /**
     * @param string $id the account id of one of your sub accounts
     */
    public function __construct(
        protected string $id,
    ) {}
}
