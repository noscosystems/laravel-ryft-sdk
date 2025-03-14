<?php

namespace Nosco\Ryft\Requests\Webhooks;

use App\Dtos\Webhooks\WebhookEndpoint;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Webhooks\ReturnsWebhookEndpoint;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * webhookUpdateById.
 *
 * This is used to update a webhook by its unique Id
 */
class WebhookUpdateById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsWebhookEndpoint;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/webhooks/{$this->webhookId}";
    }

    /**
     * @param string $webhookId Webhook Id to update
     */
    public function __construct(
        protected string $webhookId,
        protected WebhookEndpoint $webhookEndpoint,
    ) {}

    protected function defaultBody(): array
    {
        return $this->webhookEndpoint->toArray();
    }
}
