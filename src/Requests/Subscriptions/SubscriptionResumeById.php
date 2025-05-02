<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Subscriptions\ReturnsSubscription;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subscriptionResumeById.
 *
 * Use to resume a paused Subscription.
 */
class SubscriptionResumeById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsSubscription;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/subscriptions/{$this->subscriptionId}/resume";
    }

    /**
     * @param string $subscriptionId Subscription to resume
     */
    public function __construct(
        protected string $subscriptionId,
    ) {}
}
