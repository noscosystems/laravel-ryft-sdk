<?php

namespace Nosco\Ryft\Enums;

enum AccountAction: string
{
    case PAYOUT_DETAILS_REQUIRED = 'PayoutDetailsRequired';
    case PAYOUT_METHOD_REQUIRED = 'PayoutMethodRequired';
    case PAYOUT_METHOD_INVALID = 'PayoutMethodInvalid';
    case VERIFICATION_REQUIRED = 'VerificationRequired';
    case ACCOUNT_LOCKED = 'AccountLocked';
}
