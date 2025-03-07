<?php

namespace Nosco\Ryft\Requests\Customers;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * customersList.
 *
 * Used to fetch a paginated list of one or more Customers
 */
class CustomersList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/customers';
    }

    /**
     * @param null|string $email          A case insensitive email to search by. Note that emails are unique per `Customer` so you can expect a single item within the response. Any other query parameters will be ignored if this is provided.
     * @param null|int    $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp.
     * @param null|int    $endTimestamp   The timestamp when to return payment sessions up to (inclusive), it must be after the startTimestamp.
     * @param null|bool   $ascending      Control the order (newest or oldest) in which the items are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param null|int    $limit          Control how many items are return in a given page The max limit we allow is `25`. The default is `10`.
     * @param null|string $startsAfter    A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
     */
    public function __construct(
        protected ?string $email = null,
        protected ?int $startTimestamp = null,
        protected ?int $endTimestamp = null,
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter([
            'email' => $this->email,
            'startTimestamp' => $this->startTimestamp,
            'endTimestamp' => $this->endTimestamp,
            'ascending' => $this->ascending,
            'limit' => $this->limit,
            'startsAfter' => $this->startsAfter,
        ]);
    }
}
