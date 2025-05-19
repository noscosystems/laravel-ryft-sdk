<?php

namespace Nosco\Ryft\Resource;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Accounts\Account;
use Nosco\Ryft\Dtos\Accounts\AccountAuthorizationUrl;
use Nosco\Ryft\Dtos\Payouts\Payout;
use Nosco\Ryft\Requests\Accounts\PayoutCreate;
use Nosco\Ryft\Requests\Accounts\PayoutGetById;
use Nosco\Ryft\Requests\Accounts\PayoutsList;
use Nosco\Ryft\Requests\Accounts\SubAccountAuthorize;
use Nosco\Ryft\Requests\Accounts\SubAccountCreate;
use Nosco\Ryft\Requests\Accounts\SubAccountGetById;
use Nosco\Ryft\Requests\Accounts\SubAccountUpdate;
use Nosco\Ryft\Requests\Accounts\SubAccountVerify;
use Nosco\Ryft\Resource;

class Accounts extends Resource
{
    /**
     * Creates a new account that is connected to your account as a 'sub' type.
     *
     * This is for registering new users onto your platform that will act as one of your 'sub' accounts.
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/subAccountCreate Documentation
     *
     * @throws \LogicException on request failure
     */
    public function create(Account $account): Account
    {
        return $this->connector
            ->send(new SubAccountCreate($account))
            ->dtoOrFail();
    }

    /**
     * Retrieve a sub account by its ID.
     *
     * This is used to fetch details for one of your sub accounts.
     *
     * @param string $id the account id of one of your sub accounts
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/subAccountGetById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function get(string $id): Account
    {
        return $this->connector
            ->send(new SubAccountGetById($id))
            ->dtoOrFail();
    }

    /**
     * Updates one of your sub accounts.
     *
     * This is used to update the details of one of your sub accounts.
     *
     * This API can only be accessed for `NonHosted` sub accounts.
     *
     * @param string  $id      the account id of one of your sub accounts
     * @param Account $account Information to update the sub account with
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/subAccountUpdate Documentation
     *
     * @throws \LogicException on request failure
     */
    public function update(string $id, Account $account): Account
    {
        return $this->connector
            ->send(new SubAccountUpdate($id, $account))
            ->dtoOrFail();
    }

    /**
     * Submits the sub account details of a `Business` entity for verification.
     *
     * Once you have created all Persons and satisfied all the verification requirements for them and the Business,
     * you submit these details for verification.
     *
     * This endpoint cannot be accessed for `Individual` sub accounts
     * as this process is done automatically after satisfying the verification requirements.
     *
     * @param string $id the account id of one of your sub accounts
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/subAccountVerify Documentation
     *
     * @throws \LogicException on request failure
     */
    public function verify(string $id): Account
    {
        return $this->connector
            ->send(new SubAccountVerify($id))
            ->dtoOrFail();
    }

    /**
     * Gets payouts for the sub account.
     *
     * Used to fetch a paginated list of payouts for the given sub account
     *
     * @param string                 $id             the account id of one of your sub accounts
     * @param bool                   $ascending      Control the order (newest or oldest) in which the payouts are returned.
     *                                               `false` will arrange the results with newest first
     *                                               whereas `true` shows oldest first.
     * @param string|null            $startsAfter    A token to identify where to resume a subsequent paginated query.
     *                                               The value of the `paginationToken` field from that response
     *                                               should be supplied here in order to retrieve the next page of results.
     * @param DateTimeInterface|null $startDate      The date when payments were taken to search for payouts from (inclusive),
     *                                               in the format yyyy-MM-dd
     * @param DateTimeInterface|null $endDate        The date when payments were taken to search for payouts to (inclusive),
     *                                               in the format yyyy-MM-dd
     * @param DateTimeInterface|null $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp.
     * @param DateTimeInterface|null $endTimestamp   The timestamp when to return payouts up to (inclusive),
     *                                               it must be after the startTimestamp.
     *
     * @return Collection<Payout>
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/payoutsList Documentation
     *
     * @throws \LogicException on request failure
     */
    public function listPayouts(
        string $id,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null,
        ?DateTimeInterface $startDate = null,
        ?DateTimeInterface $endDate = null,
        ?DateTimeInterface $startTimestamp = null,
        ?DateTimeInterface $endTimestamp = null,
    ): Collection {
        $startDate = $startDate?->format('Y-m-d');
        $endDate = $endDate?->format('Y-m-d');
        $startTimestamp = $startTimestamp?->getTimestamp();
        $endTimestamp = $endTimestamp?->getTimestamp();

        return $this->connector
            ->send(new PayoutsList(
                $id,
                $ascending,
                $limit,
                $startsAfter,
                $startDate,
                $endDate,
                $startTimestamp,
                $endTimestamp
            ))
            ->dtoOrFail();
    }

    /**
     * Creates a manual payout for the specified sub account.
     *
     * Used to create manual payouts for a specified sub account.
     *
     * This API can only be accessed for `NonHosted` sub accounts that are configured for manual payouts.
     *
     * Note that the following requirements must be met:
     *
     *  - the `payoutMethodId` supplied must have status equal to `Valid`
     *  - `amount` must be greater than or equal to the minimum configured payout amount for the account (e.g. £100)
     *  - `verification.status` cannot be `Required` on the account
     *  - `frozen` must not be `true` on the account
     *
     * @param string $id the account id of one of your sub accounts
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/payoutCreate Documentation
     *
     * @throws \LogicException on request failure
     */
    public function createPayout(string $id, Payout $payout): Account
    {
        return $this->connector
            ->send(new PayoutCreate($id, $payout))
            ->dtoOrFail();
    }

    /**
     * Retrieve a payout by ID.
     *
     * This is used to fetch a payout by its unique ID
     *
     * @param string $id       the account id of one of your sub accounts
     * @param string $payoutId Payout to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/payoutGetById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function getPayout(string $id, string $payoutId): Payout
    {
        return $this->connector
            ->send(new PayoutGetById($id, $payoutId))
            ->dtoOrFail();
    }

    /**
     * Creates a link at which the user can sign in to their existing Ryft account
     * to authorize with your platform.
     *
     * Ryft recommends calling this endpoint first when you onboard your users
     * to cater for those that may already have Ryft accounts.
     *
     * If the email supplied is not registered with Ryft then you should instead
     * use Ryft's `/account-links` API to register a new user.
     *
     * This API can only be accessed for `Hosted` sub accounts.
     *
     * @see AccountLinks::create() for account-links endpoint
     * @link https://api-reference.ryftpay.com/#tag/Accounts/operation/subAccountAuthorize Documentation
     *
     * @throws \LogicException on request failure
     */
    public function authorize(string $email, string $redirectUrl): AccountAuthorizationUrl
    {
        return $this->connector
            ->send(new SubAccountAuthorize($email, $redirectUrl))
            ->dtoOrFail();
    }
}
