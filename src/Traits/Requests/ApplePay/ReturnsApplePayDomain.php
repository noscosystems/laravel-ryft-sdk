<?php

namespace Nosco\Ryft\Traits\Requests\ApplePay;

use Nosco\Ryft\Dtos\ApplePay\ApplePayWebDomain;

trait ReturnsApplePayDomain
{
    public function createDtoFromResponse($response): ?ApplePayWebDomain
    {
        return ApplePayWebDomain::fromResponse($response);
    }
}
