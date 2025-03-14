<?php

namespace Nosco\Ryft\Traits\Requests\Webhooks;

use Nosco\Ryft\Dtos\Webhooks\Webhook;
use Saloon\Http\Response;

trait ReturnsWebhook
{
    public function createDtoFromResponse(Response $response): ?Webhook
    {
        return Webhook::fromResponse($response);
    }
}
