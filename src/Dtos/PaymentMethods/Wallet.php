<?php

namespace Nosco\Ryft\Dtos\PaymentMethods;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Payments\WalletType;

readonly class Wallet extends Dto
{
    public function __construct(
        public ?WalletType $type = null,
        public ?string $googlePayToken = null,
        public ?string $applePayToken = null,
    ) {}
}
