<?php

namespace Nosco\Ryft\Requests\ApplePay;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * applePayWebDomainGetById.
 *
 * This is used to fetch an Apple Pay web domain by its unique Id
 */
class ApplePayWebDomainGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/apple-pay/web-domains/{$this->id}";
    }

    /**
     * @param string $id Apple Pay web domain Id to retrieve
     */
    public function __construct(
        protected string $id,
    ) {}
}
