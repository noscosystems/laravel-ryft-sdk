<?php

namespace Nosco\Ryft\Requests\Webhooks;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Webhooks\ReturnsWebhookEndpoint;
use Saloon\Enums\Method;

/**
 * webhookDeleteById.
 *
 * This is used to delete a webhook by its unique Id
 */
class WebhookDeleteById extends Request
{
    use ReturnsWebhookEndpoint;

    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/webhooks/{$this->webhookId}";
    }

    /**
     * @param string $webhookId Webhook Id to delete
     */
    public function __construct(
        protected string $webhookId,
    ) {}
}
