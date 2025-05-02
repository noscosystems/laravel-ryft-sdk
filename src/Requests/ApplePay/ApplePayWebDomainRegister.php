<?php

namespace Nosco\Ryft\Requests\ApplePay;

use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\ApplePay\ReturnsApplePayDomain;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * applePayWebDomainRegister.
 *
 * Registers a domain name for Apple Pay on the web. Note that this is required if relying on Ryft's
 * Apple Pay processing certificate.
 *
 * A **Maxiumum** of 99 domains can be registered against a single
 * Ryft account.
 *
 * Each domain must host our verification file under
 * `/.well-known/apple-developer-merchantid-domain-association`.
 *
 * **Important:** the `Content-Type` of
 * the hosted file must be `application/octet-stream`.
 */
class ApplePayWebDomainRegister extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsApplePayDomain;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/apple-pay/web-domains';
    }

    public function __construct(protected string $domainName) {}

    protected function defaultBody(): array
    {
        return [
            'domainName' => $this->domainName,
        ];
    }
}
