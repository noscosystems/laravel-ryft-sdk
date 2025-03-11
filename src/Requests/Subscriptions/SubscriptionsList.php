<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * subscriptionsList.
 *
 * Used to fetch a paginated list of subscriptions
 */
class SubscriptionsList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/subscriptions';
    }

    /**
     * @param null|int    $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp. If not provided will default to midnight on the current date (UTC).
     * @param null|int    $endTimestamp   The timestamp when to return payment sessions up to (inclusive), it must be after the startTimestamp. If not provided it will default to the current time (UTC).
     * @param null|bool   $ascending      Control the order (newest or oldest) in which the subscriptions are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param null|int    $limit          Control how many items are return in a given page The max limit we allow is `25`. The default is `10`.
     * @param null|string $startsAfter    A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
     */
    public function __construct(
        protected ?int $startTimestamp = null,
        protected ?int $endTimestamp = null,
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter([
            'startTimestamp' => $this->startTimestamp,
            'endTimestamp' => $this->endTimestamp,
            'ascending' => $this->ascending,
            'limit' => $this->limit,
            'startsAfter' => $this->startsAfter,
        ]);
    }
}
