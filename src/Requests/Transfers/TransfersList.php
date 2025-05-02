<?php

namespace Nosco\Ryft\Requests\Transfers;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Transfers\Transfer;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;

/**
 * transfersList.
 *
 * Retrieves a list of the transfers you've requested. Returned in sorted (by epoch) order (default is
 * newest first)
 */
class TransfersList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/transfers';
    }

    /**
     * @param null|bool   $ascending   Control the order (newest or oldest) in which the transfers are returned. `false` will arrange the results with newest first whereas `true` shows oldest first
     * @param null|string $startsAfter A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here in order to retrieve the next page of results.
     */
    public function __construct(
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['ascending' => $this->ascending, 'limit' => $this->limit, 'startsAfter' => $this->startsAfter]);
    }

    public function createDtoFromResponse(Response $response): Collection
    {
        return Transfer::fromPaginatedResponse($response);
    }
}
