<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
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

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/subscriptions';
    }

    public function __construct() {}
}
