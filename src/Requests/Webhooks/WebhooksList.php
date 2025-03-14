<?php

namespace Nosco\Ryft\Requests\Webhooks;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Webhooks\Webhook;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;

/**
 * webhooksList.
 *
 * Returns a list of your webhook endpoints. They are returned in sorted (by epoch) order (default is
 * newest first).
 */
class WebhooksList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/webhooks';
    }

    public function __construct() {}

    public function createDtoFromResponse(Response $response): Collection
    {
        return Webhook::fromPaginatedResponse($response);
    }
}
