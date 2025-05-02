<?php

namespace Nosco\Ryft\Requests\PayoutMethods;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\PayoutMethods\ReturnsPayoutMethod;
use Saloon\Enums\Method;

/**
 * payoutMethodGet.
 *
 * This is used to fetch a payout method by its unique Id for one of your sub accounts
 */
class PayoutMethodGet extends Request
{
    use ReturnsPayoutMethod;

    protected Method $method = Method::GET;

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
