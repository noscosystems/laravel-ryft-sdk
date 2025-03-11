<?php

namespace Nosco\Ryft\Requests\PayoutMethods;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * payoutMethodDelete.
 *
 * This is used to delete a payout method by its unique Id for one of your sub accounts
 */
class PayoutMethodDelete extends Request
{
    protected Method $method = Method::DELETE;

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
