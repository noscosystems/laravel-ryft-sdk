<?php

namespace Nosco\Ryft\Requests\Files;

use Nosco\Ryft\Dtos\Files\File;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Files\ReturnsFile;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * fileCreate.
 *
 * Upload a file to Ryft via our API. Useful if you need to:
 *   - upload evidence when challenging
 * disputes
 *   - upload KYB/KYC documents for sub accounts
 */
class FileCreate extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsFile;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/files';
    }

    public function __construct(protected File $file) {}

    protected function defaultBody(): array
    {
        return $this->file->toArray();
    }
}
