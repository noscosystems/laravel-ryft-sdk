<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Nosco\Ryft\Dtos\Subscriptions\Subscription;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Subscriptions\ReturnsSubscription;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subscriptionCreate.
 *
 * Use to create a Subscription (whereby Ryft manage the automatic scheduling and billing of a
 * recurring payment series)
 */
class SubscriptionCreate extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsSubscription;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/subscriptions';
    }

    public function __construct(protected Subscription $subscription) {}

    protected function defaultBody(): array
    {
        return $this->subscription->toArray();
    }
}
