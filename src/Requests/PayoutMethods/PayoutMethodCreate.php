<?php

namespace Nosco\Ryft\Requests\PayoutMethods;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * payoutMethodCreate.
 *
 * This is for creating payout methods for one of your sub accounts, so they can receive payouts. You
 * can only create 1 payout method per currency
 */
class PayoutMethodCreate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/payout-methods";
    }

    /**
     * @param string $id the account id of one of your sub accounts
     */
    public function __construct(
        protected string $id,
    ) {}
}
