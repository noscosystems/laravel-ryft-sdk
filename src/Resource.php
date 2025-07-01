<?php

namespace Nosco\Ryft;

use Saloon\Http\Connector;
use Saloon\PaginationPlugin\Contracts\HasPagination;

class Resource
{
    public function __construct(
        protected Connector&HasPagination $connector,
    ) {}
}
