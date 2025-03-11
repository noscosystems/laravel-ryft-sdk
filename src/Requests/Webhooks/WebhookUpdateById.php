<?php

namespace Nosco\Ryft\Requests\Webhooks;

use Nosco\Ryft\Request;
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
    ) {}
}
