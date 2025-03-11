<?php

namespace Nosco\Ryft\Requests\Accounts;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * payoutGetById.
 *
 * This is used to fetch a payout by its unique Id
 */
class PayoutGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/payouts/{$this->payoutId}";
    }

    /**
     * @param string $id       the account id of one of your sub accounts
     * @param string $payoutId Payout to retrieve
     */
    public function __construct(
        protected string $id,
        protected string $payoutId,
    ) {}
}
