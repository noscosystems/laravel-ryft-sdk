<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Subscriptions\ReturnsSubscription;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subscriptionCancelById.
 *
 * Cancel a subscription by its unique Id. This will immediately move the subscription to `Cancelled`
 * and stop billing the customer. This state is terminal and cannot be reversed.
 */
class SubscriptionCancelById extends Request
{
    use HasJsonBody;
    use ReturnsSubscription;

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
        protected ?string $reason = null,
    ) {}

    protected function defaultBody(): array
    {
        return array_filter([
            'reason' => $this->reason,
        ]);
    }
}
