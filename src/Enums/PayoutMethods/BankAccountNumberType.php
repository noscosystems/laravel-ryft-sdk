<?php

namespace Nosco\Ryft\Enums\PayoutMethods;

enum BankAccountNumberType: string
{
    case IBAN = 'Iban';
    case GB = 'UnitedKingdom';
    case US = 'UnitedStates';
}
