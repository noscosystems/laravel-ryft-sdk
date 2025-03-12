<?php

namespace Nosco\Ryft;

use JsonException;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;

class CursorPaginator extends \Saloon\PaginationPlugin\CursorPaginator
{
    public function __construct(
        Connector $connector,
        Request $request,
        protected string $paginationTokenKey,
        protected string $paginatedItemsKey,
        protected string $cursorQueryParam,
        protected string $pageLimitQueryParam,
    ) {
        parent::__construct($connector, $request);
    }

    /**
     * @throws JsonException
     */
    protected function getNextCursor(Response $response): int|string
    {
        return $response->json($this->paginationTokenKey);
    }

    /**
     * @throws JsonException
     */
    protected function isLastPage(Response $response): bool
    {
        return $response->json($this->paginationTokenKey) === null;
    }

    /**
     * @throws JsonException
     */
    protected function getPageItems(Response $response, Request $request): array
    {
        return $response->json($this->paginatedItemsKey);
    }

    /**
     * @throws JsonException
     */
    protected function applyPagination(Request $request): Request
    {
        if ($this->currentResponse instanceof Response) {
            $request->query()->add($this->cursorQueryParam, $this->getNextCursor($this->currentResponse));
        }
        if (isset($this->perPageLimit)) {
            $request->query()->add($this->pageLimitQueryParam, $this->perPageLimit);
        }

        return $request;
    }
}
