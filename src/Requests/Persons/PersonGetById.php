<?php

namespace Nosco\Ryft\Requests\Persons;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * personGetById.
 *
 * This is used to fetch a person by its unique Id
 */
class PersonGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/persons/{$this->personId}";
    }

    /**
     * @param string $id       the account id of one of your sub accounts
     * @param string $personId Person to retrieve
     */
    public function __construct(
        protected string $id,
        protected string $personId,
    ) {}
}
