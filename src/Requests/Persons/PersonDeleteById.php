<?php

namespace Nosco\Ryft\Requests\Persons;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * personDeleteById.
 *
 * Deletes a person under the account. This will also delete any files currently attached to the
 * person. Note that you can only delete a person if `verification.status` is `NotRequired` or
 * `Required`
 */
class PersonDeleteById extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/persons/{$this->personId}";
    }

    /**
     * @param string $id       the account id of one of your sub accounts
     * @param string $personId Person to delete
     */
    public function __construct(
        protected string $id,
        protected string $personId,
    ) {}
}
