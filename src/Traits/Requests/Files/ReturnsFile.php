<?php

namespace Nosco\Ryft\Traits\Requests\Files;

use Nosco\Ryft\Dtos\Files\File;
use Saloon\Http\Response;

trait ReturnsFile
{
    public function createDtoFromResponse(Response $response): ?File
    {
        return File::fromResponse($response);
    }
}
