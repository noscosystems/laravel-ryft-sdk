<?php

namespace Nosco\Ryft\Enums\Accounts;

enum VerificationStatus: string
{
    case NOT_REQUIRED = 'NotRequired';
    case REQUIRED = 'Required';
    case PENDING_VERIFICATION = 'PendingVerification';
    case VERIFIED = 'Verified';
}
