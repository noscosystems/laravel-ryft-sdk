<?php

namespace Nosco\Ryft\Requests\Files;

use Nosco\Ryft\Request;
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

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/files';
    }

    public function __construct() {}
}
