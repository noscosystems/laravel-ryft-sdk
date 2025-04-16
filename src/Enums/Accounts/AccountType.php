<?php

namespace Nosco\Ryft\Enums;

enum AccountStatus: string
{
    case ACTION_REQUIRED = 'ActionRequired';
    case UNVERIFIED = 'Unverified';
    case VERIFICATION_PENDING = 'VerificationPending';
    case VERIFIED = 'Verified';
}
