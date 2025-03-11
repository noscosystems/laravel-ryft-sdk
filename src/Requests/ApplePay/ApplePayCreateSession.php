<?php

namespace Nosco\Ryft\Requests\ApplePay;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * applePayCreateSession.
 *
 * Request a new Apple Pay web session. Use this endpoint if you process Apple Pay on the web and:
 *   -
 * you want to rely on Ryft's Apple Pay processing certificate
 *   - have an existing integration or want
 * to implement Apple Pay via our API (without using our SDKs)
 */
class ApplePayCreateSession extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/apple-pay/sessions';
    }

    public function __construct() {}
}
