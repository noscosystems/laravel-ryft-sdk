<?php

namespace Nosco\Ryft\Enums\Payments;

enum Initiator: string
{
    case CUSTOMER = 'Customer';
    case MERCHANT = 'Merchant';
}
