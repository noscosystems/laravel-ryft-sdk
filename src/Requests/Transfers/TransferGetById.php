<?php

namespace Nosco\Ryft\Requests\Transfers;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * transferGetById.
 *
 * This is used to fetch a transfer by its unique Id
 */
class TransferGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/transfers/{$this->id}";
    }

    /**
     * @param string $id Transfer to retrieve
     */
    public function __construct(
        protected string $id,
    ) {}
}
