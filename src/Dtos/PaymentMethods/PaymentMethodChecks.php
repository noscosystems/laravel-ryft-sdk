<?php

namespace Nosco\Ryft\Dtos\PaymentMethods;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Payments\AvsResponseCode;
use Nosco\Ryft\Enums\Payments\CvvResponseCode;

readonly class PaymentMethodChecks extends Dto
{
    public function __construct(
        public ?AvsResponseCode $avsResponseCode = null,
        public ?CvvResponseCode $cvvResponseCode = null,
    ) {}
}
