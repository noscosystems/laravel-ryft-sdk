<?php

namespace Nosco\Ryft\Traits\Requests\ApplePay;

use Nosco\Ryft\Dtos\ApplePay\ApplePayDomain;

trait ReturnsApplePayDomain
{
    public function createDtoFromResponse($response): ?ApplePayDomain
    {
        return ApplePayDomain::fromResponse($response);
    }
}
