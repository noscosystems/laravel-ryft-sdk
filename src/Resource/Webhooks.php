<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Requests\Webhooks\WebhookCreate;
use Nosco\Ryft\Requests\Webhooks\WebhookDeleteById;
use Nosco\Ryft\Requests\Webhooks\WebhookGetById;
use Nosco\Ryft\Requests\Webhooks\WebhooksList;
use Nosco\Ryft\Requests\Webhooks\WebhookUpdateById;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Webhooks extends Resource
{
    /**
     * List your webhook endpoints.
     *
     * Returns a list of your webhook endpoints.
     *
     * They are returned in sorted (by epoch) order (default is newest first).
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhooksList Documentation
     */
    public function list(): Response
    {
        return $this->connector->send(new WebhooksList);
    }

    /**
     * Create/Register a webhook endpoint.
     *
     * Create/Register a webhook endpoint to start receiving events
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookCreate Documentation
     */
    public function create(): Response
    {
        return $this->connector->send(new WebhookCreate);
    }

    /**
     * Retrieve a webhook endpoint.
     *
     * This is used to fetch a webhook by its unique ID
     *
     * @param string $webhookId Webhook Id to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookGetById Documentation
     */
    public function get(string $webhookId): Response
    {
        return $this->connector->send(new WebhookGetById($webhookId));
    }

    /**
     * Delete a webhook endpoint.
     *
     * This is used to delete a webhook by its unique ID
     *
     * @param string $webhookId Webhook Id to delete
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookDeleteById Documentation
     */
    public function delete(string $webhookId): Response
    {
        return $this->connector->send(new WebhookDeleteById($webhookId));
    }

    /**
     * Update a webhook endpoint.
     *
     * This is used to update a webhook by its unique ID
     *
     * @param string $webhookId Webhook Id to update
     *
     * @link https://api-reference.ryftpay.com/#tag/Webhooks/operation/webhookUpdateById Documentation
     */
    public function update(string $webhookId): Response
    {
        return $this->connector->send(new WebhookUpdateById($webhookId));
    }
}
