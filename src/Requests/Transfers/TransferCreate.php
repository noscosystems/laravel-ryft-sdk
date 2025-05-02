<?php

namespace Nosco\Ryft\Requests\Transfers;

use Nosco\Ryft\Dtos\Transfers\Transfer;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Transfers\ReturnsTransfer;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * transferCreate.
 *
 * Used to initiate a transfer of money between Ryft accounts.
 */
class TransferCreate extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsTransfer;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/transfers';
    }

    public function __construct(protected Transfer $transfer) {}

    protected function defaultBody(): array
    {
        return $this->transfer->toArray();
    }
}
