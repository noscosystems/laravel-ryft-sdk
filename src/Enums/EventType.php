<?php

namespace Nosco\Ryft\Enums;

use Nosco\Ryft\Traits\Enums\TriesMultiple;

enum EventType: string
{
    use TriesMultiple;

    case PAYMENT_SESSION_APPROVED = 'PaymentSession.approved';
    case PAYMENT_SESSION_CAPTURED = 'PaymentSession.captured';
    case PAYMENT_SESSION_DECLINED = 'PaymentSession.declined';
    case PAYMENT_SESSION_VOIDED = 'PaymentSession.voided';
    case PAYMENT_SESSION_VOID_FAILED = 'PaymentSession.void_failed';
    case PAYMENT_SESSION_REFUNDED = 'PaymentSession.refunded';
    case PAYMENT_SESSION_REFUND_FAILED = 'PaymentSession.refund_failed';
    case PAYMENT_SESSION_REQUIRES_ACTION = 'PaymentSession.requires_action';

    case ACCOUNT_CREATED = 'Account.created';
    case ACCOUNT_UPDATED = 'Account.updated';
    case ACCOUNT_VERIFICATION_STATUS_UPDATED = 'Account.verification_status_updated';

    case PERSON_CREATED = 'Person.created';
    case PERSON_UPDATED = 'Person.updated';
    case PERSON_DELETED = 'Person.deleted';

    case PAYOUT_METHOD_CREATED = 'PayoutMethod.created';
    case PAYOUT_METHOD_UPDATED = 'PayoutMethod.updated';
    case PAYOUT_METHOD_DELETED = 'PayoutMethod.deleted';

    case PAYOUT_CREATED = 'Payout.created';
    case PAYOUT_STATUS_UPDATED = 'Payout.status_updated';

    case CUSTOMER_CREATED = 'Customer.created';
    case CUSTOMER_UPDATED = 'Customer.updated';
    case CUSTOMER_DELETED = 'Customer.deleted';

    case SUBSCRIPTION_CREATED = 'Subscription.created';
    case SUBSCRIPTION_UPDATED = 'Subscription.updated';
    case SUBSCRIPTION_CANCELLED = 'Subscription.cancelled';
    case SUBSCRIPTION_PAST_DUE = 'Subscription.past_due';
    case SUBSCRIPTION_ENDED = 'Subscription.ended';

    case TRANSFER_CREATED = 'Transfer.created';
    case TRANSFER_UPDATED = 'Transfer.updated';

    case DISPUTE_CREATED = 'Dispute.created';
    case DISPUTE_CLOSED = 'Dispute.closed';
    case DISPUTE_CHALLENGED = 'Dispute.challenged';
}
