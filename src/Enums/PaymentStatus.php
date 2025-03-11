<?php

namespace Nosco\Ryft\Enums;

enum PaymentStatus: string
{
    case PENDING_PAYMENT = 'PendingPayment';
    case PENDING_ACTION = 'PendingAction';
    case PROCESSING = 'Processing';
    case APPROVED = 'Approved';
    case CAPTURED = 'Captured';
    case VOIDED = 'Voided';
}
