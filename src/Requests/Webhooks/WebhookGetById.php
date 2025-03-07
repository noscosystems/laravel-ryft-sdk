<?php

namespace Nosco\Ryft\Requests\Webhooks;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * webhookGetById.
 *
 * This is used to fetch a webhook by its unique Id
 */
class WebhookGetById extends Request
{
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
