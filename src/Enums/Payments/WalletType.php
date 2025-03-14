<?php

namespace Nosco\Ryft\Enums\Payments;

enum WalletType: string
{
    case GOOGLE_PAY = 'GooglePay';
    case APPLE_PAY = 'ApplePay';
}
