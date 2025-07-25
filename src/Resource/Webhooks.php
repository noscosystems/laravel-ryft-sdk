<?php

namespace Nosco\Ryft\Resource;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Webhooks\Webhook;
use Nosco\Ryft\Requests\Webhooks\WebhookCreate;
use Nosco\Ryft\Requests\Webhooks\WebhookDeleteById;
use Nosco\Ryft\Requests\Webhooks\WebhookGetById;
use Nosco\Ryft\Requests\Webhooks\WebhooksList;
use Nosco\Ryft\Requests\Webhooks\WebhookUpdateById;
use Nosco\Ryft\Resource;

class Webhooks extends Resource
{
    /**
     * List your webhook endpoints.
     *
     * Returns a list of your webhook endpoints.
     *
     * They are returned in sorted (by epoch) order (default is newest first).
     *
     * @return Collection<Webhook>
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhooksList Documentation
     *
     * @throws \LogicException on request failure
     */
    public function list(): Collection
    {
        return $this->connector
            ->send(new WebhooksList)
            ->dtoOrFail();
    }

    /**
     * Create/Register a webhook endpoint.
     *
     * Create/Register a webhook endpoint to start receiving events
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookCreate Documentation
     *
     * @throws \LogicException on request failure
     */
    public function create(Webhook $webhookEndpoint): Webhook
    {
        return $this->connector
            ->send(new WebhookCreate($webhookEndpoint))
            ->dtoOrFail();
    }

    /**
     * Retrieve a webhook endpoint.
     *
     * This is used to fetch a webhook by its unique ID
     *
     * @param string $webhookId Webhook Id to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookGetById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function get(string $webhookId): Webhook
    {
        return $this->connector
            ->send(new WebhookGetById($webhookId))
            ->dtoOrFail();
    }

    /**
     * Delete a webhook endpoint.
     *
     * This is used to delete a webhook by its unique ID
     *
     * @param string $webhookId Webhook Id to delete
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookDeleteById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function delete(string $webhookId): Webhook
    {
        return $this->connector
            ->send(new WebhookDeleteById($webhookId))
            ->dtoOrFail();
    }

    /**
     * Update a webhook endpoint.
     *
     * This is used to update a webhook by its unique ID
     *
     * @param string $webhookId Webhook Id to update
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookUpdateById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function update(string $webhookId, Webhook $webhookEndpoint): Webhook
    {
        return $this->connector
            ->send(new WebhookUpdateById($webhookId, $webhookEndpoint))
            ->dtoOrFail();
    }
}
