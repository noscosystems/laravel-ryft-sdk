<?php

namespace Nosco\Ryft\Traits\Requests\Webhooks;

use Nosco\Ryft\Dtos\Webhooks\WebhookEndpoint;
use Saloon\Http\Response;

trait ReturnsWebhookEndpoint
{
    public function createDtoFromResponse(Response $response): ?WebhookEndpoint
    {
        return WebhookEndpoint::fromResponse($response);
    }
}
