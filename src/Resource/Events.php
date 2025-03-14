<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Requests\Events\EventGetById;
use Nosco\Ryft\Requests\Events\EventGetList;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Events extends Resource
{
    /**
     * Retrieves events in sorted (by epoch) order.
     *
     * Retrieves a list of events. They are returned in sorted (by epoch) order (default is newest first).
     * You can query one of your sub-account's events buy using the `Account` header.
     *
     * @param bool|null $ascending Control the order (newest or oldest) in which the events are returned. `false` will arrange the results with newest first whereas `true` shows oldest first.
     * @param int|null  $limit     Control how many items are returned in the result list. The max limit we allow is `50`.
     *
     * @link https://api-reference.ryftpay.com/#tag/Events/operation/eventGetList Documentation
     */
    public function list(?bool $ascending = null, ?int $limit = null): Response
    {
        return $this->connector->send(new EventGetList($ascending, $limit));
    }

    /**
     * Retrieve an Event by ID.
     *
     * This is used to fetch an Event by its `eventId`
     *
     * @param string $eventId Event to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Events/operation/eventGetById Documentation
     */
    public function get(string $eventId): Response
    {
        return $this->connector->send(new EventGetById($eventId));
    }
}
