<?php

namespace Nosco\Ryft\Requests\Persons;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * personList.
 *
 * Retrieves a list of the persons you've created for one of your sub accounts They are returned in
 * sorted (by epoch) order (default is newest first)
 */
class PersonList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/persons";
    }

    /**
     * @param string      $id          the account id of one of your sub accounts
     * @param null|bool   $ascending   Control the order (newest or oldest) in which the persons are returned. `false` will arrange the results with newest first whereas `true` shows oldest first.
     * @param null|string $startsAfter A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results.
     */
    public function __construct(
        protected string $id,
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['ascending' => $this->ascending, 'limit' => $this->limit, 'startsAfter' => $this->startsAfter]);
    }
}
