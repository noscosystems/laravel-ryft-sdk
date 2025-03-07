<?php

namespace Nosco\Ryft\Requests\Persons;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * personUpdateById.
 *
 * This is used to update an existing person
 */
class PersonUpdateById extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/persons/{$this->personId}";
    }

    /**
     * @param string $id       the account id of one of your sub accounts
     * @param string $personId Person to update
     */
    public function __construct(
        protected string $id,
        protected string $personId,
    ) {}
}
