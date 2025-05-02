<?php

namespace Nosco\Ryft\Requests\Files;

use Nosco\Ryft\Dtos\Files\File;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Files\ReturnsFile;
use Saloon\Enums\Method;

/**
 * fileGetById.
 *
 * Retrieve a file by its unique ID
 */
class FileGetById extends Request
{
    use ReturnsFile;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/files/{$this->fileId}";
    }

    /**
     * @param string $fileId File to retrieve
     */
    public function __construct(
        protected string $fileId,
    ) {}
}
