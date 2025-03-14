<?php

namespace Nosco\Ryft\Enums\Payments;

enum CardScheme: string
{
    case VISA = 'Visa';
    case MASTERCARD = 'Mastercard';
    case AMERICAN_EXPRESS = 'Amex';
}
