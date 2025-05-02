<?php

namespace Nosco\Ryft\Requests\Persons;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Persons\ReturnsPerson;
use Saloon\Enums\Method;

/**
 * personGetById.
 *
 * This is used to fetch a person by its unique Id
 */
class PersonGetById extends Request
{
    use ReturnsPerson;

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
