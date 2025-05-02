<?php

namespace Nosco\Ryft\Requests\PlatformFees;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\PlatformFees\PlatformFee;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;

/**
 * platformFeeGetList.
 *
 * Retrieves a list of the application fees you've collected. They are returned in sorted (by epoch)
 * order (default is newest first)
 */
class PlatformFeeGetList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/platform-fees';
    }

    /**
     * @param null|bool $ascending Control the order (newest or oldest) in which the platform fees are returned. `false` will arrange the results with newest first whereas `true` shows oldest first
     */
    public function __construct(
        protected ?bool $ascending = null,
        protected ?int $limit = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter([
            'ascending' => $this->ascending,
            'limit' => $this->limit,
        ]);
    }

    public function createDtoFromResponse(Response $response): Collection
    {
        return PlatformFee::fromPaginatedResponse($response);
    }
}
