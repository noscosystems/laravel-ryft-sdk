<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * subscriptionGetById.
 *
 * This is used to fetch a subscription by its unique Id
 */
class SubscriptionGetById extends Request
{
    protected Method $method = Method::GET;

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
