<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * subscriptionCancelById.
 *
 * Cancel a subscription by its unique Id. This will immediately move the subscription to `Cancelled`
 * and stop billing the customer. This state is terminal and cannot be reversed.
 */
class SubscriptionCancelById extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/subscriptions/{$this->subscriptionId}/cancel";
    }

    /**
     * @param string $subscriptionId Subscription to cancel
     */
    public function __construct(
        protected string $subscriptionId,
    ) {}
}
