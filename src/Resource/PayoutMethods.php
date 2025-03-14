<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Requests\PayoutMethods\PayoutMethodCreate;
use Nosco\Ryft\Requests\PayoutMethods\PayoutMethodDelete;
use Nosco\Ryft\Requests\PayoutMethods\PayoutMethodGet;
use Nosco\Ryft\Requests\PayoutMethods\PayoutMethodsList;
use Nosco\Ryft\Requests\PayoutMethods\PayoutMethodUpdate;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class PayoutMethods extends Resource
{
    /**
     * Retrieves payout methods in sorted (by epoch) order.
     *
     * Retrieves a list of the payout methods you've created for one of your sub accounts.
     * They are returned in sorted (by epoch) order (default is newest first).
     *
     * @param string      $id          the account id of one of your sub accounts
     * @param bool|null   $ascending   Control the order (newest or oldest) in which the payout methods are returned. `false` will arrange the results with newest first whereas `true` shows oldest first
     * @param int|null    $limit       Control how many items are return in a given page The max limit we allow is `25`. The default is `10`.
     * @param string|null $startsAfter A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results.
     *
     * @link https://api-reference.ryftpay.com/#tag/Payout-Methods/operation/payoutMethodsList Documentation
     */
    public function list(string $id, ?bool $ascending = null, ?int $limit = null, ?string $startsAfter = null): Response
    {
        return $this->connector->send(new PayoutMethodsList($id, $ascending, $limit, $startsAfter));
    }

    /**
     * Creates a new payout method for a sub account.
     *
     * This is for creating payout methods for one of your sub accounts,
     * so they can receive payouts.
     *
     * You can only create 1 payout method per currency.
     *
     * @param string $id the account id of one of your sub accounts
     *
     * @link https://api-reference.ryftpay.com/#tag/Payout-Methods/operation/payoutMethodCreate Documentation
     */
    public function create(string $id): Response
    {
        return $this->connector->send(new PayoutMethodCreate($id));
    }

    /**
     * Retrieve a payout method by ID.
     *
     * This is used to fetch a payout method by its unique ID for one of your sub accounts
     *
     * @param string $id             the account id of one of your sub accounts
     * @param string $payoutMethodId Payout method to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Payout-Methods/operation/payoutMethodGet Documentation
     */
    public function get(string $id, string $payoutMethodId): Response
    {
        return $this->connector->send(new PayoutMethodGet($id, $payoutMethodId));
    }

    /**
     * Delete a payout method.
     *
     * This is used to delete a payout method by its unique ID for one of your sub accounts
     *
     * @param string $id             the account id of one of your sub accounts
     * @param string $payoutMethodId Payout method to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Payout-Methods/operation/payoutMethodDelete Documentation
     */
    public function delete(string $id, string $payoutMethodId): Response
    {
        return $this->connector->send(new PayoutMethodDelete($id, $payoutMethodId));
    }

    /**
     * Update a payout method by ID.
     *
     * This is used to update an existing payout method for one of your sub accounts
     *
     * @param string $id             the account id of one of your sub accounts
     * @param string $payoutMethodId Payout method to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Payout-Methods/operation/payoutMethodUpdate Documentation
     */
    public function update(string $id, string $payoutMethodId): Response
    {
        return $this->connector->send(new PayoutMethodUpdate($id, $payoutMethodId));
    }
}
