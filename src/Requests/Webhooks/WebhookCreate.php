<?php

namespace Nosco\Ryft\Requests\Webhooks;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * webhookCreate.
 *
 * Create/Register a webhook endpoint to start receiving events
 */
class WebhookCreate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/webhooks';
    }

    public function __construct() {}
}
