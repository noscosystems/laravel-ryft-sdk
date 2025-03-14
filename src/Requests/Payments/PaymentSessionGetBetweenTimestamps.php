<?php

namespace Nosco\Ryft\Requests\Payments;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Payments\PaymentSession;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * paymentSessionGetBetweenTimestamps.
 *
 * This is used to fetch payment sessions within a timestamp range, paginated
 */
class PaymentSessionGetBetweenTimestamps extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/payment-sessions';
    }

    /**
     * @param null|int    $startTimestamp The timestamp when to return payment sessions from (inclusive), it must be before the endTimestamp. If not provided it will default to midnight on the current date (UTC).
     * @param null|int    $endTimestamp   The timestamp when to return payment sessions up to (inclusive), it must be after the startTimestamp. If not provided it will default to the current time (UTC).
     * @param null|bool   $ascending      Control the order (newest or oldest) in which the payment sessions are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param null|int    $limit          Control how many items are return in a given page The max limit we allow is `50`. The default is `10`.
     * @param null|string $startsAfter    A token to identify the payment session to start querying after. This is most commonly used to get the next page of results after a previous response did not return all payment sessions, due to the imposed `limit`. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
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

    public function createDtoFromResponse(Response $response): Collection
    {
        return PaymentSession::fromPaginatedResponse($response);
    }
}
