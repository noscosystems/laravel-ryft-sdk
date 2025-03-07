<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subscriptionUpdateById.
 *
 * Use to update a Subscription. **Cannot** be used if the Subscription is `Cancelled` or `Ended`.
 */
class SubscriptionUpdateById extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/subscriptions/{$this->subscriptionId}";
    }

    /**
     * @param string $subscriptionId Subscription to retrieve
     */
    public function __construct(
        protected string $subscriptionId,
    ) {}
}
