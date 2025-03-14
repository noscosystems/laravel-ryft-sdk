<?php

namespace Nosco\Ryft\Requests\Webhooks;

use App\Dtos\Webhooks\WebhookEndpoint;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Webhooks\ReturnsWebhookEndpoint;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * webhookCreate.
 *
 * Create/Register a webhook endpoint to start receiving events
 */
class WebhookCreate extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsWebhookEndpoint;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/webhooks';
    }

    public function __construct(protected WebhookEndpoint $webhookEndpoint) {}

    protected function defaultBody(): array
    {
        return $this->webhookEndpoint->toArray();
    }
}
