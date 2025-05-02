<?php

namespace Nosco\Ryft\Traits\Requests\Persons;

use Nosco\Ryft\Dtos\Persons\Person;
use Saloon\Http\Response;

trait ReturnsPerson
{
    public function createDtoFromResponse(Response $response): ?Person
    {
        return Person::fromResponse($response);
    }
}
