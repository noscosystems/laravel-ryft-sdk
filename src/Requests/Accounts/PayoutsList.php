<?php

namespace Nosco\Ryft\Requests\Accounts;

use Nosco\Ryft\Dtos\Payouts\Payout;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;

/**
 * payoutsList.
 *
 * Used to fetch a paginated list of payouts for the given sub account
 */
class PayoutsList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/payouts";
    }

    /**
     * @param string      $id             the account id of one of your sub accounts
     * @param null|bool   $ascending      Control the order (newest or oldest) in which the payouts are returned. `false` will arrange the results with newest first whereas `true` shows oldest first.
     * @param null|string $startsAfter    A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here in order to retrieve the next page of results.
     * @param null|string $startDate      The date when payments were taken to search for payouts from (inclusive), in the format yyyy-MM-dd
     * @param null|string $endDate        The date when payments were taken to search for payouts to (inclusive), in the format yyyy-MM-dd
     * @param null|int    $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp.
     * @param null|int    $endTimestamp   The timestamp when to return payouts up to (inclusive), it must be after the startTimestamp.
     */
    public function __construct(
        protected string $id,
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
        protected ?string $startDate = null,
        protected ?string $endDate = null,
        protected ?int $startTimestamp = null,
        protected ?int $endTimestamp = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter([
            'ascending' => $this->ascending,
            'limit' => $this->limit,
            'startsAfter' => $this->startsAfter,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'startTimestamp' => $this->startTimestamp,
            'endTimestamp' => $this->endTimestamp,
        ]);
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Payout::fromPaginatedResponse($response);
    }
}
