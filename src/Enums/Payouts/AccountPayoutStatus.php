<?php

namespace Nosco\Ryft\Enums\Payouts;

enum AccountPayoutStatus: string
{
    case COMPLETED = 'Completed';
    case FAILED = 'Failed';
    case PENDING = 'Pending';
    case PENDING_ACCOUNT_VERIFICATION = 'PendingAccountVerification';
    case PENDING_TRANSACTION_VERIFICATION = 'PendingTransactionVerification';
    case PENDING_PAYOUT_METHOD_VERIFICATION = 'PendingPayoutMethodVerification';
    case PENDING_ACCOUNT_ACTION = 'PendingAccountAction';
    case IN_PROGRESS = 'InProgress';
    case CANCELLED = 'Cancelled';
    case EXPIRED = 'Expired';
    case RECALLED = 'Recalled';
    case RETURNED = 'Returned';
}
