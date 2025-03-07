<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Requests\Customers\CustomerCreate;
use Nosco\Ryft\Requests\Customers\CustomerDeleteById;
use Nosco\Ryft\Requests\Customers\CustomerGetById;
use Nosco\Ryft\Requests\Customers\CustomerGetPaymentMethods;
use Nosco\Ryft\Requests\Customers\CustomersList;
use Nosco\Ryft\Requests\Customers\CustomerUpdateById;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Customers extends Resource
{
    /**
     * Used to fetch a paginated list of one or more Customers.
     *
     * @param string|null $email          A case insensitive email to search by. Note that emails are unique per `Customer` so you can expect a single item within the response. Any other query parameters will be ignored if this is provided.
     * @param int|null    $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp.
     * @param int|null    $endTimestamp   The timestamp when to return payment sessions up to (inclusive), it must be after the startTimestamp.
     * @param bool        $ascending      Control the order (newest or oldest) in which the items are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param int|null    $limit          Control how many items are return in a given page The max limit we allow is `25`. The default is `10`.
     * @param string|null $startsAfter    A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
     *
     * @link https://api-reference.ryftpay.com/#tag/Customers/operation/customersList Documentation
     */
    public function list(
        ?string $email,
        ?int $startTimestamp,
        ?int $endTimestamp,
        ?bool $ascending,
        ?int $limit,
        ?string $startsAfter,
    ): Response {
        return $this->connector->send(new CustomersList($email, $startTimestamp, $endTimestamp, $ascending, $limit, $startsAfter));
    }

    /**
     * Creates a new customer within your account.
     *
     * This is for creating customers within your Ryft account (to enable features such as saved payment methods)
     *
     * @link https://api-reference.ryftpay.com/#tag/Customers/operation/customerCreate Documentation
     */
    public function create(): Response
    {
        return $this->connector->send(new CustomerCreate);
    }

    /**
     * Retrieve a customer by ID.
     *
     * This is used to fetch a customer by its unique ID
     *
     * @param string $customerId Customer to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Customers/operation/customerGetById Documentation
     */
    public function get(string $customerId): Response
    {
        return $this->connector->send(new CustomerGetById($customerId));
    }

    /**
     * Delete a customer (and all their payment methods).
     *
     * This is used to delete a customer by its unique ID
     *
     * @param string $customerId Customer to delete
     *
     * @link https://api-reference.ryftpay.com/#tag/Customers/operation/customerDeleteById Documentation
     */
    public function delete(string $customerId): Response
    {
        return $this->connector->send(new CustomerDeleteById($customerId));
    }

    /**
     * Update a customer by ID.
     *
     * This is used to update an existing customer
     *
     * @param string $customerId Customer to update
     *
     * @link https://api-reference.ryftpay.com/#tag/Customers/operation/customerUpdateById Documentation
     */
    public function update(string $customerId): Response
    {
        return $this->connector->send(new CustomerUpdateById($customerId));
    }

    /**
     * Retrieve a customer's payment methods.
     *
     * This is used to fetch a customer's payment methods
     *
     * @param string $customerId Customer whose payment methods to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Customers/operation/customerGetPaymentMethods Documentation
     */
    public function listPaymentMethods(string $customerId): Response
    {
        return $this->connector->send(new CustomerGetPaymentMethods($customerId));
    }
}
