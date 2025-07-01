<?php

namespace Nosco\Ryft\Requests\Files;

use Nosco\Ryft\Dtos\Files\File;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * filesList.
 *
 * Used to fetch a paginated list of files under your account
 */
class FilesList extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/files';
    }

    /**
     * @param null|string $category    Filter for files in a specific category.
     * @param null|bool   $ascending   Control the order (newest or oldest) in which the files are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param null|int    $limit       Control how many items are return in a given page The max limit we allow is `25`. The default is `10`.
     * @param null|string $startsAfter A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
     */
    public function __construct(
        protected ?string $category = null,
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter([
            'category' => $this->category,
            'ascending' => $this->ascending,
            'limit' => $this->limit,
            'startsAfter' => $this->startsAfter,
        ]);
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return File::fromPaginatedResponse($response);
    }
}
