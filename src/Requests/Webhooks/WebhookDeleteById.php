<?php

namespace Nosco\Ryft\Requests\Webhooks;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * webhookDeleteById.
 *
 * This is used to delete a webhook by its unique Id
 */
class WebhookDeleteById extends Request
{
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
