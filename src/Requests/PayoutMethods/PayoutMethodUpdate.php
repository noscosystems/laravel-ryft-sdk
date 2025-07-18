<?php

namespace Nosco\Ryft\Requests\PayoutMethods;

use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\PayoutMethods\ReturnsPayoutMethod;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * payoutMethodUpdate.
 *
 * This is used to update an existing payout method for one of your sub accounts
 */
class PayoutMethodUpdate extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsPayoutMethod;

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
        protected PayoutMethod $payoutMethod,
    ) {}

    protected function defaultBody(): array
    {
        return $this->payoutMethod->toArray();
    }
}
