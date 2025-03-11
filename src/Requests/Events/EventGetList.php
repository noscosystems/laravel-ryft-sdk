<?php

namespace Nosco\Ryft\Requests\Events;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * eventGetList.
 *
 * Retrieves a list of events. They are returned in sorted (by epoch) order (default is newest first).
 * You can query one of your sub-account's events buy using the `Account` header.
 */
class EventGetList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/events';
    }

    /**
     * @param null|bool $ascending Control the order (newest or oldest) in which the events are returned. `false` will arrange the results with newest first whereas `true` shows oldest first.
     */
    public function __construct(
        protected ?bool $ascending = null,
        protected ?int $limit = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['ascending' => $this->ascending, 'limit' => $this->limit]);
    }
}
