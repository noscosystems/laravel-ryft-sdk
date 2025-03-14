<?php

namespace Nosco\Ryft\Requests\Webhooks;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Webhooks\ReturnsWebhook;
use Saloon\Enums\Method;

/**
 * webhookGetById.
 *
 * This is used to fetch a webhook by its unique Id
 */
class WebhookGetById extends Request
{
    use ReturnsWebhook;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/webhooks/{$this->webhookId}";
    }

    /**
     * @param string $webhookId Webhook Id to retrieve
     */
    public function __construct(
        protected string $webhookId,
    ) {}
}
