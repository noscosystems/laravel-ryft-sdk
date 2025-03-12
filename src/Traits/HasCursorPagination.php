<?php

namespace Nosco\Ryft\Traits;

use Nosco\Ryft\CursorPaginator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Paginator;

trait HasCursorPagination
{
    public function paginate(Request $request): Paginator
    {
        return new CursorPaginator(
            connector: $this->paginationConnector(),
            request: $request,
            paginationTokenKey: $this->paginationTokenKey(),
            paginatedItemsKey: $this->paginationItemsKey(),
            cursorQueryParam: $this->paginationCursorQueryParam(),
            pageLimitQueryParam: $this->paginationLimitQueryParam(),
        );
    }

    protected function paginationConnector(): Connector
    {
        return $this;
    }

    protected function paginationTokenKey(): string
    {
        return 'paginationToken';
    }

    protected function paginationItemsKey(): string
    {
        return 'items';
    }

    protected function paginationCursorQueryParam(): string
    {
        return 'startsAfter';
    }

    protected function paginationLimitQueryParam(): string
    {
        return 'limit';
    }
}
