<?php

namespace Nosco\Ryft\Requests\ApplePay;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\ApplePay\ReturnsApplePayDomain;
use Saloon\Enums\Method;

/**
 * applePayWebDomainDeleteById.
 *
 * This is used to delete an Apple Pay web domain by its unique Id
 */
class ApplePayWebDomainDeleteById extends Request
{
    use ReturnsApplePayDomain;

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
