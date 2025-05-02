<?php

namespace Nosco\Ryft\Traits\Requests\Subscriptions;

use Nosco\Ryft\Dtos\Subscriptions\Subscription;
use Saloon\Http\Response;

trait ReturnsSubscription
{
    public function createDtoFromResponse(Response $response): ?Subscription
    {
        return Subscription::fromResponse($response);
    }
}
