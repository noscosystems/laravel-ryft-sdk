<?php

namespace Nosco\Ryft\Requests\PayoutMethods;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * payoutMethodUpdate.
 *
 * This is used to update an existing payout method for one of your sub accounts
 */
class PayoutMethodUpdate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/payout-methods/{$this->payoutMethodId}";
    }

    /**
     * @param string $id             the account id of one of your sub accounts
     * @param string $payoutMethodId Payout method to retrieve
     */
    public function __construct(
        protected string $id,
        protected string $payoutMethodId,
    ) {}
}
