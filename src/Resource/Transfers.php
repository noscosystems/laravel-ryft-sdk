<?php

namespace Nosco\Ryft\Resource;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Transfers\Transfer;
use Nosco\Ryft\Requests\Transfers\TransferCreate;
use Nosco\Ryft\Requests\Transfers\TransferGetById;
use Nosco\Ryft\Requests\Transfers\TransfersList;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Transfers extends Resource
{
    /**
     * Fetches a paginated list of your transfers.
     *
     * Retrieves a list of the transfers you've requested.
     *
     * Returned in sorted (by epoch) order (default is newest first)
     *
     * @param bool|null   $ascending   Control the order (newest or oldest) in which the transfers are returned.
     *                                 `false` will arrange the results with newest first whereas `true` shows oldest first
     * @param int|null    $limit       Control how many transfers are returned in the result list. The max limit we allow is `50`.
     * @param string|null $startsAfter A token to identify where to resume a subsequent paginated query.
     *                                 The value of the `paginationToken` field from that response should be supplied here
     *                                 in order to retrieve the next page of results.
     *
     * @return Collection<Transfer>
     *
     * @link https://api-reference.ryftpay.com/#tag/Transfers/operation/transfersList Documentation
     *
     * @throws \LogicException on request failure
     */
    public function list(?bool $ascending = null, ?int $limit = null, ?string $startsAfter = null): Collection
    {
        return $this->connector
            ->send(new TransfersList($ascending, $limit, $startsAfter))
            ->dtoOrFail();
    }

    /**
     * Initiates a transfer of money between Ryft accounts.
     *
     * Used to initiate a transfer of money between Ryft accounts.
     *
     * @link https://api-reference.ryftpay.com/#tag/Transfers/operation/transfersCreate Documentation
     *
     * @throws \LogicException on request failure
     */
    public function create(Transfer $transfer): Transfer
    {
        return $this->connector
            ->send(new TransferCreate($transfer))
            ->dtoOrFail();
    }

    /**
     * Retrieves a transfer by its ID.
     *
     * This is used to fetch a transfer by its unique ID.
     *
     * @param string $id Transfer to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Transfers/operation/transfersGetById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function get(string $id): Transfer
    {
        return $this->connector
            ->send(new TransferGetById($id))
            ->dtoOrFail();
    }
}
