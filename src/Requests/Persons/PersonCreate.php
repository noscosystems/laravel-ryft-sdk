<?php

namespace Nosco\Ryft\Requests\Persons;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * personCreate.
 *
 * This is for creating persons under your or your sub accounts account, required for verification of
 * businesses. The following limits apply: - Maximum of 9 persons - Maximum of 5 persons with a role of
 * `Director` - Maximum of 4 persons with a role of `UltimateBeneficialOwner` - Maximum of 1 person
 * with a role of `BusinessContact`
 */
class PersonCreate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/accounts/{$this->id}/persons";
    }

    /**
     * @param string $id the account id of one of your sub accounts
     */
    public function __construct(
        protected string $id,
    ) {}
}
