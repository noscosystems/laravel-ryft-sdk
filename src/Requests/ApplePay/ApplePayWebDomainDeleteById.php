<?php

namespace Nosco\Ryft\Requests\ApplePay;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * applePayWebDomainDeleteById.
 *
 * This is used to delete an Apple Pay web domain by its unique Id
 */
class ApplePayWebDomainDeleteById extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/apple-pay/web-domains/{$this->id}";
    }

    /**
     * @param string $id Apple Pay web domain Id to delete
     */
    public function __construct(
        protected string $id,
    ) {}
}
