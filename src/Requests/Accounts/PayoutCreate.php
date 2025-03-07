<?php

namespace Nosco\Ryft\Requests\Accounts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * payoutCreate.
 *
 * Used to create manual payouts for a specified sub account.
 * This API can only be accessed for
 * `NonHosted` sub accounts that are configured for manual payouts.
 * **Note** that the following
 * requirements must be met:
 *   - the `payoutMethodId` supplied must have status equal to `Valid`
 *   -
 * `amount` must be greater than or equal to the minimum configured payout amount for the account (e.g.
 * £100)
 *   - `verification.status` cannot be `Required` on the account
 *   - `frozen` must not be `true`
 * on the account
 */
class PayoutCreate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/payouts";
    }

    /**
     * @param string $id the account id of one of your sub accounts
     */
    public function __construct(
        protected string $id,
    ) {}
}
