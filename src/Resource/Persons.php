<?php

namespace Nosco\Ryft\Resource;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Persons\Person;
use Nosco\Ryft\Requests\Persons\PersonCreate;
use Nosco\Ryft\Requests\Persons\PersonDeleteById;
use Nosco\Ryft\Requests\Persons\PersonGetById;
use Nosco\Ryft\Requests\Persons\PersonList;
use Nosco\Ryft\Requests\Persons\PersonUpdateById;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Persons extends Resource
{
    /**
     * Retrieves persons in sorted (by epoch) order.
     *
     * Retrieves a list of the persons you've created for one of your sub accounts.
     *
     * They are returned in sorted (by epoch) order (default is newest first).
     *
     * @param string      $id          the account id of one of your sub accounts
     * @param bool|null   $ascending   Control the order (newest or oldest) in which the persons are returned.
     *                                 `false` will arrange the results with newest first whereas `true` shows oldest first.
     * @param string|null $startsAfter A token to identify where to resume a subsequent paginated query.
     *                                 The value of the `paginationToken` field from that response should be supplied here,
     *                                 to retrieve the next page of results.
     *
     * @return Collection<Person>
     *
     * @link https://api-reference.ryftpay.com/#tag/Persons/operation/personList Documentation
     */
    public function list(
        string $id,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null
    ): Collection {
        return $this->connector
            ->send(new PersonList($id, $ascending, $limit, $startsAfter))
            ->dtoOrFail();
    }

    /**
     * Creates a new person under the account, for verification of Businesses.
     *
     * This is for creating persons under your or your sub accounts account,
     * required for verification of businesses.
     *
     * The following limits apply:
     *  - Maximum of 9 persons
     *  - Maximum of 5 persons with a role of `Director`
     *  - Maximum of 4 persons with a role of `UltimateBeneficialOwner`
     *  - Maximum of 1 person with a role of `BusinessContact`
     *
     * @param string $id the account id of one of your sub accounts
     *
     * @link https://api-reference.ryftpay.com/#tag/Persons/operation/personCreate Documentation
     */
    public function create(string $id, Person $person): Person
    {
        return $this->connector
            ->send(new PersonCreate($id, $person))
            ->dtoOrFail();
    }

    /**
     * Retrieve a person by ID.
     *
     * This is used to fetch a person by its unique ID
     *
     * @param string $id       the account id of one of your sub accounts
     * @param string $personId Person to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Persons/operation/personGetById Documentation
     */
    public function get(string $id, string $personId): Person
    {
        return $this->connector
            ->send(new PersonGetById($id, $personId))
            ->dtoOrFail();
    }

    /**
     * Update a person by ID.
     *
     * This is used to update an existing person
     *
     * @param string $id       the account id of one of your sub accounts
     * @param string $personId Person to delete
     *
     * @link https://api-reference.ryftpay.com/#tag/Persons/operation/personDeleteById Documentation
     */
    public function delete(string $id, string $personId): Person
    {
        return $this->connector
            ->send(new PersonDeleteById($id, $personId))
            ->dtoOrFail();
    }

    /**
     * Deletes a person by ID.
     *
     * Deletes a person under the account.
     * This will also delete any files currently attached to the person.
     *
     * Note that you can only delete a person if `verification.status` is `NotRequired` or `Required`.
     *
     * @param string $id       the account id of one of your sub accounts
     * @param string $personId Person to update
     *
     * @link https://api-reference.ryftpay.com/#tag/Persons/operation/personUpdateById Documentation
     */
    public function update(string $id, string $personId, Person $person): Person
    {
        return $this->connector
            ->send(new PersonUpdateById($id, $personId, $person))
            ->dtoOrFail();
    }
}
